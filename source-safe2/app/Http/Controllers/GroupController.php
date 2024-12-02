<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupRequest;
use App\Services\GroupService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    protected $groupService;
    protected $userService;

    public function __construct(GroupService $groupService,UserService $userService)
    {
        $this->groupService = $groupService ;
        $this->userService = $userService ;
    }
    public function create(){
        $users = $this->userService->getAllUser();
        return view('groups.create',compact('users'));
    }
    public function store(CreateGroupRequest $request)
    {
        $this->groupService->createGroup($request->validated(), Auth::id());
        return redirect()->route('groups.index')->with('success', 'Group created successfully!');
    }
}
