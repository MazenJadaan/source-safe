<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Models\File;
use App\Models\User;
use App\Services\FilesService;
use App\Services\GroupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Lcobucci\JWT\Exception;

class FilesController extends Controller
{
    protected $filesService;
    protected $groupService;

    public function __construct(FilesService $filesService,GroupService $groupService)
    {
        $this->filesService = $filesService;
        $this->groupService = $groupService;
    }

    public function store(UploadFileRequest $request){
        try {
            $this->filesService->uploadFile($request->validated(), Auth::id());
            // Success message
            return redirect()->back()->with('success', 'File uploaded successfully!');
        } catch (\Exception $e) {
            // Error message
            return redirect()->back()->with('error', 'Failed to upload file: ' . $e->getMessage());
        }
    }

    public function getFilesUser(Request $request){
        $user = Auth::user();
        $search = $request->input('search');
        $groups  =  $this->groupService->getUserGroups(Auth::id());
        $files = $this->filesService->getFilesForUsers($user,$search, 5);
        return view('files.user-files', compact('files', 'groups'));
    }
    public function getMyFiles(Request $request){
        $user = Auth::user();
        $search = $request->input('search');
        $files = $this->filesService->getMyReservationFiles($user,$search,5);
        return view('files.user-reservation-files', compact('files'));

    }
    public function checkIn(Request $request, $id)
    {
        Log::info($request);
        $request->validate([
            'version' => 'required|integer',
        ]);

        try {
            // استدعاء الخدمة لتحديث الحالة
            $filePath = $this->filesService->checkIn($id, $request->input('version'));

            session()->flash('success', 'File checked-in successfully.');

            // تحميل الملف
            return response()->download($filePath);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());

            // Redirect back or to another page with the error message
            return redirect()->back();
        }
    }
    public function checkOut(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file', // تحقق من رفع الملف
        ]);

        try {
            // استدعاء الخدمة لتنفيذ العملية
            $this->filesService->checkOut($id, $request->file('file'));

            // إعادة التوجيه مع رسالة نجاح
            return redirect()->back()->with('success', 'File checked-out and updated successfully.');
        } catch (\Exception $e) {
            // إعادة التوجيه مع رسالة خطأ
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function tracing(Request $request)
    {
        $files = File::with([
            'group',
            'creator',
            'backupFiles' => function($query) {
                $query->latest();
            },
            'backupFiles.updater'
        ])->paginate(10); // التقسيم ل 10 عناصر بالصفحة
    
        return view('files.tracing', compact('files'));
    }

}
