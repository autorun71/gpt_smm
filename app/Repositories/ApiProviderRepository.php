<?php

namespace App\Repositories;

use App\Models\ApiProvider;

class ApiProviderRepository
{
    public function findById($id)
    {
        return ApiProvider::find($id);
    }

    public function save(ApiProvider $apiProvider)
    {
        $apiProvider->save();
    }

    public function delete(ApiProvider $apiProvider)
    {
        $apiProvider->delete();
    }
}
