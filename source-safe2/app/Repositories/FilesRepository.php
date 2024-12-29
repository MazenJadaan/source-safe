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

}
