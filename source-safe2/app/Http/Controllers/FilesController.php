<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Services\FilesService;
use App\Services\GroupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
