<?php

namespace App\Services;

use App\Repositories\OperationRepository;

class OperationService
{
    protected $OperationRepository ;
    public function __construct(OperationRepository $OperationRepository)
    {
     $this->OperationRepository = $OperationRepository;
    }
    /**
     * Get operations for a specific file.
     *
     * @param int $fileId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFileOperations($fileId)
    {
        return $this->OperationRepository->getOperationsByFile($fileId);
    }

    /**
     * Get operations for a specific user.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserOperations($userId)
    {
        return $this->OperationRepository->getOperationsByUser($userId);
    }
}
