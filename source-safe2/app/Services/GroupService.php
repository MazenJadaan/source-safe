<?php

namespace App\Services;

use App\Repositories\GroupRepository;

class GroupService
{
    protected $GroupRepository ;

    public function __construct(GroupRepository $GroupRepository)
    {
      $this->GroupRepository = $GroupRepository ;
    }
    public function createGroup( $request, $userId){

    }

}
