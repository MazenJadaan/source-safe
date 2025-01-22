<?php

namespace App\Services;


use App\Repositories\FilesRepository;
use App\Repositories\FilesRequestsRepository;
use App\Utils\FileUtility;
use Illuminate\Support\Facades\Storage;

class FilesRequestsService
{
    protected $FilesRequestsRepository ;
    protected $fileRepository;

    public function __construct(FilesRequestsRepository $FilesRequestsRepository
    ,FilesRepository $fileRepository
    )
    {
        $this->FilesRequestsRepository = $FilesRequestsRepository;
        $this->fileRepository = $fileRepository ;
    }
    public function uploadFileRequest($validatedData, $user_id)
    {
        $data = $validatedData;

        if (request()->hasFile('file')) {
            $filePath = FileUtility::storeFile(request()->file('file'), 'files');
            $data['file_path'] = $filePath;
        }
        $data['uploaded_by'] = $user_id;
        $this->FilesRequestsRepository->create($data);
    }
    public function acceptFileRequest($id)
    {
        // Find the file request
        $fileRequest = $this->FilesRequestsRepository->findById($id);

        if (!$fileRequest) {
            throw new \Exception("File request not found.");
        }

        // Save the file request to the files table
        $fileData = [
            'name' => $fileRequest->file_name,
            'created_by' => $fileRequest->uploaded_by,
            'path' => $fileRequest->file_path,
            'group_id' => $fileRequest->group_id,
            'status' => 'free'
        ];
        $this->fileRepository->create($fileData);

        // Remove the file request from the file_requests table
        $this->FilesRequestsRepository->delete($id);

        return 'File accepted and moved to files of group.';
    }


    public function rejectFileRequest($id)
    {
        // Delete the file request
        $fileRequest = $this->FilesRequestsRepository->findById($id);

        if (!$fileRequest) {
            throw new \Exception("File request not found.");
        }

        $this->FilesRequestsRepository->delete($id);

        return 'File request rejected successfully.';
    }
    public function downloadFile($id)
    {
        // Find the file request
        $fileRequest = $this->FilesRequestsRepository->findById($id);

        if (!$fileRequest) {
            throw new \Exception("File request not found.");
        }

        // File path relative to the 'public' disk
        $filePath = $fileRequest->file_path; // This assumes the `file_path` is stored as 'file_requests/filename.ext'

        // Check if the file exists using your utility class
        if (!Storage::disk('public')->exists($filePath)) {
            throw new \Exception("File not found on disk.");
        }

        // Generate the absolute file path for download
        $absoluteFilePath = storage_path("app/public/{$filePath}");

        // Return the file download response
        return response()->download($absoluteFilePath);
    }


}
