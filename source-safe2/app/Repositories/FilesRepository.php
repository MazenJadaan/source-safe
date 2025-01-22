<?php

namespace App\Repositories;

use App\Models\File;
use Laravel\Pail\Files;

class FilesRepository extends BaseRepository
{
    public function __construct(File $model)
    {
        parent::__construct($model);
    }

    public function getAllUserFilesByGroups(array $groupIds, $search = null, $perPage = 10)
    {
        $query = File::with(['group', 'creator', 'backupFiles'])
            ->whereIn('group_id', $groupIds);

        // Apply search if provided
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')  // Search by file name
                ->orWhereHas('group', function($q) use ($search) { // Search by group name
                    $q->where('name', 'like', '%' . $search . '%');
                })
                    ->orWhereHas('creator', function($q) use ($search) { // Search by creator name
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        // Apply pagination
        return $query->paginate($perPage);
    }

    public function getMyReservationFiles($userId, $search = null, $perPage = 10)
    {
        $query = File::whereIn('id', function($query) use ($userId) {
            $query->select('file_id')
                ->from('operations')
                ->where('user_id', $userId)
                ->where('type', 'check_in');
        });

        // Apply search if provided
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')  // Search by file name
                ->orWhereHas('group', function($q) use ($search) { // Search by group name
                    $q->where('name', 'like', '%' . $search . '%');
                })
                    ->orWhereHas('creator', function($q) use ($search) { // Search by creator name
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        // Apply pagination
        return $query->paginate($perPage);
    }

}
