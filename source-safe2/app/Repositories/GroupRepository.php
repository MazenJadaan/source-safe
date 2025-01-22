<?php

namespace App\Repositories;

use App\Models\FileRequest;
use App\Models\Group;
use App\Models\User;

class GroupRepository extends BaseRepository
{
    public function __construct(Group $model)
    {
        parent::__construct($model);
    }

    /**
     * Add users to a group with admin status.
     *
     * @param Group $group
     * @param array $users
     * @param int $adminId
     */
    public function attachUsers(Group $group, array $users, $adminId)
    {
        $groupUsers = [];

        // Add all selected users
        if(!isset($users)){
            foreach ($users as $userId) {
                $groupUsers[$userId] = ['is_admin' => $userId === $adminId];
            }
        }
        // Add the creator as admin
        $groupUsers[$adminId] = ['is_admin' => true];

        $group->users()->sync($groupUsers);
    }
    public function getUserGroups($userId,$search = null,$perPage =10){
        $user = User::find($userId);
        $query = $user->groups();
        if ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }
        return $query->paginate($perPage);
    }
    public function getGroupMembers($groupId = null){
        return Group::with('users')->findOrFail($groupId)->users;
    }
    public function getGroupFiles($groupId = null)
    {
        return Group::with('files')->findOrFail($groupId)->files;
    }
    public function getFilesOrders($groupId = null)
    {
        return FileRequest::where('group_id', $groupId)
            ->with('uploader') // Assuming 'user' is a relationship to fetch uploader details
            ->get();
    }
}
