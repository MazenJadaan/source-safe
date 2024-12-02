<?php

namespace App\Services;

use App\Repositories\FilesRepository;

class FilesService
{
    protected $FilesRepository ;

    public function __construct(FilesRepository $FilesRepository)
    {
     $this->FilesRepository = $FilesRepository;
    }
}
