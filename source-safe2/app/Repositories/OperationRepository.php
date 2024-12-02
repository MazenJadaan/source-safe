<?php

namespace App\Repositories;

use App\Models\Operation;

class OperationRepository
{
    public function __construct(Operation $model)
    {
        parent::__construct($model);
    }
}
