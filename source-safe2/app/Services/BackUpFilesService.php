<?php

namespace App\Services;

use App\Repositories\BackUpFilesRepository;

class BackUpFilesService
{
    protected $BackUpFilesRepository ;
    public function __construct(BackUpFilesRepository $BackUpFilesRepository)
    {
       $this->BackUpFilesRepository = $BackUpFilesRepository ;
    }
}
