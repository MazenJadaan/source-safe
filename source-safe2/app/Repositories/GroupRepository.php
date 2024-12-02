<?php

namespace App\Repositories;

use App\Models\Group;

class GroupRepository extends BaseRepository
{
    public function __construct(Group $model)
    {
        parent::__construct($model);
    }

    public function addUsersToGroup($group, $users, $isAdmin = false)
    {
        $group->users()->sync(
            collect($users)->mapWithKeys(function ($userId) use ($isAdmin) {
                return [$userId => ['is_admin' => $isAdmin]];
            })->toArray()
        );
    }
}
