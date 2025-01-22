<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Services\FilesRequestsService;
use App\Services\FilesService;
use App\Services\GroupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilesRequestController extends Controller
{
    protected $filesRequestService;

    public function __construct(FilesRequestsService $filesRequestService)
    {
        $this->filesRequestService = $filesRequestService;

    }
    public function upload(UploadFileRequest $request){
        try {
            $this->filesRequestService->uploadFileRequest($request->validated(), Auth::id());
            // Success message
            return redirect()->back()->with('success', 'File request submitted successfully!');
        } catch (\Exception $e) {
            // Error message
            return redirect()->back()->with('error', 'Failed to submit file request: ' . $e->getMessage());
        }
    }
    public function acceptFile($id)
    {
        try {
            $message = $this->filesRequestService->acceptFileRequest($id);
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function rejectFile($id)
    {
        try {
            $message = $this->filesRequestService->rejectFileRequest($id);
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function downloadFile($id)
    {
        try {
            return $this->filesRequestService->downloadFile($id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
