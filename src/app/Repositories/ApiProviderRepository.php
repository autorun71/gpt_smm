<?php

namespace App\Repositories;

use App\Models\ApiProvider;

class ApiProviderRepository extends BaseRepository
{
    protected function getModelInstance()
    {
        return new ApiProvider();
    }
}
