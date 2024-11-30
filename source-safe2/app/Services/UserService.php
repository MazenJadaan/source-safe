<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService extends BaseService
{
    protected $UserRepository ;
    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }


    // Add any User-specific service logic here
}
