<?php

namespace App\Http\Controllers;

use App\Services\BackUpFilesService;
use Illuminate\Http\Request;

class BackUpController extends Controller
{
    protected $backUpService;

    public function __construct(BackUpFilesService $backUpService)
    {
        $this->backUpService = $backUpService;
    }
}
