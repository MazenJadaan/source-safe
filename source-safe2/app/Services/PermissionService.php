<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService
{
    protected $PermissionRepository ;
    public function __construct(PermissionRepository $PermissionRepository)
    {
        $this->PermissionRepository = $PermissionRepository;
    }
}
