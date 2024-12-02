<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository
{
    public $model ;
    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->model = $model ;
    }
    public function getAllExceptAuth(){
        return User::where('id','!=',Auth::id())->get();
    }


    // Add any User-specific repository logic here
}
