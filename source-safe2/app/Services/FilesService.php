<?php

namespace App\Services;

use App\Repositories\FilesRepository;
use App\Utils\FileUtility;

class FilesService
{
    protected $FilesRepository ;

    public function __construct(FilesRepository $FilesRepository)
    {
     $this->FilesRepository = $FilesRepository;
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

}
