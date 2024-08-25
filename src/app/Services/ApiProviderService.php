<?php

namespace App\Services;

use App\Models\ApiProvider;
use App\Repositories\ApiProviderRepository;

class ApiProviderService
{
    protected $apiProviderRepository;

    public function __construct(ApiProviderRepository $apiProviderRepository)
    {
        $this->apiProviderRepository = $apiProviderRepository;
    }

    public function createApiProvider(array $data)
    {
        $apiProvider = new ApiProvider($data);
        $this->apiProviderRepository->save($apiProvider);
        return $apiProvider;
    }

    public function updateApiProvider(ApiProvider $apiProvider, array $data)
    {
        $apiProvider->update($data);
        $this->apiProviderRepository->save($apiProvider);
    }

    public function deleteApiProvider(ApiProvider $apiProvider)
    {
        $this->apiProviderRepository->delete($apiProvider);
    }
}
