<?php

namespace App\Repositories;

use App\Models\BackupFile;

class BackUpFilesRepository extends BaseRepository
{
    public function __construct(BackupFile $model)
    {
        parent::__construct($model);
    }
}
