<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService
{
    protected $RoleRepository ;
    public function __construct(RoleRepository $RoleRepository)
    {
        $this->RoleRepository = $RoleRepository;
    }
}
