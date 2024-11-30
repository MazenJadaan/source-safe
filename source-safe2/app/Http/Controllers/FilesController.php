<?php

namespace App\Http\Controllers;

use App\Services\FilesService;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    protected $filesService;

    public function __construct(FilesService $filesService)
    {
        $this->filesService = $filesService;
    }
}
