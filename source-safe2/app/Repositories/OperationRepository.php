<?php

namespace App\Repositories;

use App\Models\Operation;

class OperationRepository extends BaseRepository
{
    public function __construct(Operation $model)
    {
        parent::__construct($model);
    }
    /**
     * Get operations for a specific file.
     *
     * @param int $fileId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getOperationsByFile($fileId)
    {
        return Operation::where('file_id', $fileId)->with('user')->get();
    }

    /**
     * Get operations for a specific user.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getOperationsByUser($userId)
    {
        return Operation::where('user_id', $userId)->with('file')->get();
    }
    public function logOperation($fileId, $userId, $type)
    {
        Operation::create([
            'file_id' => $fileId,
            'user_id' => $userId,
            'type' => $type,
        ]);
    }
    }
