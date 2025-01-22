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

    public function getFilesForUsers($user,$search = null, $perPage = 10)
    {
        return $this->FilesRepository->getAllUserFilesByGroups($user->groups->pluck('id')->toArray(), $search,$perPage);
    }
    public function getMyReservationFiles($user,$search = null, $perPage = 10){
        return $this->FilesRepository->getMyReservationFiles($user->id,$search,$perPage);
    }

}
