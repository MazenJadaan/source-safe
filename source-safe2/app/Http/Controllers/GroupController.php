<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
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
    public function myGroups(Request $request){
        $userId = Auth::id();
        $search = $request->input('search');
        $groups = $this->groupService->getUserGroups($userId,$search,5);
        return view('groups.user-groups',compact('groups'));
    }
    public function create(){
        $users = $this->userService->getAllUserExceptAuth();
        return view('groups.create',compact('users'));
    }
    public function store(CreateGroupRequest $request)
    {
        try {
            $this->groupService->createGroup($request->validated(), Auth::id());
            // Success message
            return redirect()->back()->with('success', 'Group created successfully!');
        } catch (\Exception $e) {
            // Error message
            return redirect()->back()->with('error', 'Failed to create group: ' . $e->getMessage());
        }
    }
    public function update(UpdateGroupRequest $request , $group){
        try {
            $isUpdated =  $this->groupService->updateGroup($request->validated(),$group);
            if ($isUpdated){
                return redirect()->back()->with('success', 'Group updated successfully!');
            }
            // Success message
        } catch (\Exception $e) {
            // Error message
            return redirect()->back()->with('error', 'Failed to updated group: ' . $e->getMessage());
        }
    }
    public function delete($id){
     try {
         $is_deleted = $this->groupService->deleteGroup($id);
         if ($is_deleted) {
             return redirect()->back()->with('success', 'Group deleted successfully!');
         }
     }
         catch(\Exception $e){
             return redirect()->back()->with('error', 'Failed to create group: ' . $e->getMessage());

         }
     }
     public function details($id){
        $group = $this->groupService->getGroupById($id);
        return view('groups.details',compact('group'));
     }
     public function members($id){
         $members = $this->groupService->getGroupMembers($id);
         return view('groups.group-members', compact('members'));
     }
     public function files($id){
        $files = $this->groupService->getGroupFiles($id);
        return view('groups.group-files',compact('files'));
     }
     public function filesOrders($id){
         $fileRequests  = $this->groupService->getFilesOrders($id);
         return view('groups.group-add-files-orders',compact('fileRequests'));
     }

}
