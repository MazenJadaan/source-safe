<?php

namespace App\Repositories;

use App\Models\FileRequest;

class FilesRequestsRepository extends BaseRepository
{
    public function __construct(FileRequest $model)
    {
        parent::__construct($model);
    }
}
