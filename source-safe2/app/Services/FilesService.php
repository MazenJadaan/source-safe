<?php

namespace App\Services;

use App\Repositories\BackUpFilesRepository;
use App\Repositories\FilesRepository;
use App\Repositories\OperationRepository;
use App\Utils\FileUtility;
use Illuminate\Support\Facades\DB;
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

            if (!$file) {
                throw new \Exception('The file has already reserved by another user.');
            }

            // تحديث حالة الملف والإصدار
            $this->FilesRepository->updateFileStatusAndVersion(
                $file->id,
                'reserved',
                auth()->id(),
                $file->version + 1
            );

            // تسجيل العملية في جدول العمليات
            $this->OperationRepository->logOperation($file->id, auth()->id(), 'check_in');

            // إرجاع مسار الملف لتحميله
            return storage_path("app/public/{$file->path}");
        });
    }

    public function checkOut($fileId, $newFile)
    {
        DB::transaction(function () use ($fileId, $newFile) {

            $file = $this->FilesRepository->findById($fileId);

            if (!$file || $file->status !== 'reserved') {
                throw new \Exception('The file is not reserved or does not exist.');
            }

            $backupPath = 'backup_files/' . basename($file->path);
            Storage::disk('public')->move($file->path, $backupPath);


            $this->BackUpFilesRepository->create([
                'path' => $backupPath,
                'file_id' => $file->id,
                'version' => $file->version - 1 ,
                'updated_by' => auth()->id(),
            ]);

            $newFilePath = $newFile->storeAs('files', basename($file->path), 'public');

            $this->FilesRepository->updateFileAfterCheckOut(
                $fileId,
                $newFilePath,
                'free', // Change status to 'free'
                null    // Remove the reservation
            );

            // Log the check-out operation
            $this->OperationRepository->logOperation($fileId, auth()->id(), 'check_out');
        });
    }

}
