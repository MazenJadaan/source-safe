<?php

namespace App\Services;

class FilesRequestsService
{
    protected $FilesRequestsRepository ;

    public function __construct(FilesRepository $FilesRequestsRepository)
    {
        $this->FilesRequestsRepository = $FilesRequestsRepository;
    }
}
