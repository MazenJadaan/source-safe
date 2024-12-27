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

    public function create(){
       $groups  =  $this->groupService->getUserGroups(Auth::id());
        return view('files.create',compact('groups'));
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
}
