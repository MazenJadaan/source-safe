<?php

namespace App\Services;

use App\Models\BackupFile;
use App\Models\File;
use App\Models\Group;
use App\Notifications\UserNotification;
use App\Repositories\BackUpFilesRepository;
use App\Repositories\FilesRepository;
use App\Repositories\OperationRepository;
use App\Utils\FileUtility;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FilesService
{
    protected $FilesRepository ;
    protected $BackUpFilesRepository ;
    protected $OperationRepository ;


    public function __construct(FilesRepository $FilesRepository,OperationRepository $OperationRepository , BackUpFilesRepository $BackUpFilesRepository)
    {
     $this->FilesRepository = $FilesRepository;
     $this->OperationRepository = $OperationRepository;
     $this->BackUpFilesRepository = $BackUpFilesRepository ;
    }
    public function uploadFile($validatedData , $user_id){
        $data = $validatedData;
        if (request()->hasFile('file')) {
            $filePath = FileUtility::storeFile(request()->file('file'),'files');
            $data['path'] = $filePath;
        }
        $data['created_by'] = $user_id ;

        $this->FilesRepository->create($data);
    }

    public function getFilesForUsers($user,$search = null, $perPage = 10)
    {
        return $this->FilesRepository->getAllUserFilesByGroups($user->groups->pluck('id')->toArray(), $search,$perPage);
    }
    public function getMyReservationFiles($user,$search = null, $perPage = 10){
        return $this->FilesRepository->getMyReservationFiles($user->id,$search,$perPage);
    }

    public function checkIn($fileId, $version)
    {
        return DB::transaction(function () use ($fileId, $version) {

            // البحث عن الملف بالحالة "free" والإصدار المطلوب
            $file = $this->FilesRepository->findFreeFileWithVersion($fileId, $version);

          
            // تحديث حالة الملف والإصدار
            $this->FilesRepository->updateFileStatusAndVersion(
                $file->id,
                'reserved',
                auth()->id(),
                $file->version + 1
            );

            // تسجيل العملية في جدول العمليات
            $this->OperationRepository->logOperation($file->id, auth()->id(), 'check_in');



            //
          $group_id= File::where('id',$fileId)->pluck('group_id');
          
            $group=Group::find($group_id[0]);
            $groupUsers=$group->users;
            Log::info($groupUsers);
            foreach ($groupUsers as $user) {
               $notification=$user->notify(new UserNotification([
                'title' => '📂 تحديث جديد على الملف!',
                'message' => "The user " . auth()->user()->name . " performed a '" . __('check-in') . "' operation on the file '" . $file->name . "' in the group '" . $group->name . "'. You can check the details now.",
                'url' => "/my-files",
            ]));}

            // إرجاع مسار الملف لتحميله
            return storage_path("app/public/{$file->path}");
        });
    }

    public function checkOut($fileId, $newFile)
    {
        DB::transaction(function () use ($fileId, $newFile) {
    
            $file = $this->FilesRepository->findById($fileId);
    
            // if (!$file || $file->status !== 'reserved') {
            //     Log::info("TThe file is not reserved or does not exist. ");

            // }
    
            // عمل نسخة احتياطية من الملف القديم
            $backupPath = 'files/' . basename($file->path);
            Storage::disk('public')->move($file->path, $backupPath);
    
            // حساب التجزئة للملف الجديد
            $fileContent = file_get_contents($newFile->getRealPath());
            $newHash = hash('sha256', $fileContent);
    
            // جلب أحدث نسخة من قاعدة البيانات
            $latestVersion = BackupFile::where('file_id', $fileId)
                                        ->orderBy('created_at', 'desc')
                                        ->first();
    
            // if ($latestVersion && $latestVersion->hash === $newHash) {
            //     Log::info("The new file is identical to the latest version. Update rejected ");
            // }
    
            // تسجيل الفرق بين الملفات في السجل
            $oldFileContent = file_get_contents(storage_path('app/public/' . $backupPath));
            $diff = $this->calculateDiff($oldFileContent, $fileContent);
            Log::info("File differences for File ID $fileId:", ['diff' => $diff]);
    
            // إضافة النسخة الاحتياطية الجديدة
           $n= $this->BackUpFilesRepository->create([
                'path' => $backupPath,
                'file_id' => $file->id,
                'version' => ($latestVersion->version ?? 0) + 1,
                'hash' => $newHash,
                'contentChanges'=>$diff,
                'updated_by' => auth()->id(),
            ]);
            Log::info("File n for File ID $fileId:", ['n' => $n]);

            // تحديث مسار الملف الجديد
            $newFilePath = $newFile->storeAs('files', basename($file->path), 'public');
            Log::info("newFilePath n for File ID $fileId:", ['newFilePath' => $newFilePath]);

            // تحديث حالة الملف الأصلي
           $upd= $this->FilesRepository->updateFileAfterCheckOut(
                $fileId,
                $newFilePath,
                'free', // تغيير الحالة إلى 'free'
                null    // إزالة الحجز
            );
            Log::info("upd n for File ID $fileId:", ['upd' => $upd]);

            // تسجيل العملية
           $log= $this->OperationRepository->logOperation($fileId, auth()->id(), 'check_out');
            Log::info("log n for File ID $fileId:", ['log' => $log]);

            $group_id= File::where('id',$fileId)->pluck('group_id');
          
            $group=Group::find($group_id[0]);
            $groupUsers=$group->users;
            Log::info($groupUsers);
            foreach ($groupUsers as $user) {
               $notification=$user->notify(new UserNotification([
                'title' => '📂 تحديث جديد على الملف!',
                'message' => "The user " . auth()->user()->name . " performed a '" . __('check-out') . "' operation on the file '" . $file->name . "' in the group '" . $group->name . "'. You can check the details now.",
                'url' => "/my-files",
            ]));}
    
        });
    }
    
    /**
     * حساب الفروقات بين ملفين.
     */
    private function calculateDiff($oldContent, $newContent)
    {
        $oldLines = explode(PHP_EOL, $oldContent);
        $newLines = explode(PHP_EOL, $newContent);
    
        $diff = [];
        foreach ($oldLines as $index => $line) {
            if (!isset($newLines[$index]) || $line !== $newLines[$index]) {
                $diff[] = "Line " . ($index + 1) . ": \nOld: " . ($line ?: 'NULL') . "\nNew: " . ($newLines[$index] ?? 'NULL');

            }
        }
    return implode(PHP_EOL . str_repeat('-', 20) . PHP_EOL, $diff);

        return $diff;
    }
    

}
