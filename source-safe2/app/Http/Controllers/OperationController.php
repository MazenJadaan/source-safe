<?php

namespace App\Http\Controllers;

use App\Services\OperationService;
use Illuminate\Http\Request;

class OperationController extends Controller
{

    protected $operationService;

    public function __construct(OperationService $operationService)
    {
        $this->operationService = $operationService;
    }
}
