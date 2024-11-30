<?php

namespace App\Services;

use App\Repositories\OperationRepository;

class OperationService
{
    protected $OperationRepository ;
    public function __construct(OperationRepository $OperationRepository)
    {
     $this->OperationRepository = $OperationRepository;
    }
}
