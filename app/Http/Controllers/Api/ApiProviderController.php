<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ApiProviderRepository;
use Illuminate\Http\Request;

class ApiProviderController extends Controller
{
    protected $apiProviderRepository;

    public function __construct(ApiProviderRepository $apiProviderRepository)
    {
        $this->apiProviderRepository = $apiProviderRepository;
    }

    public function index()
    {
        return response()->json($this->apiProviderRepository->all());
    }

    public function show($id)
    {
        return response()->json($this->apiProviderRepository->findById($id));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $apiProvider = new ApiProvider($data);
        $this->apiProviderRepository->save($apiProvider);
        return response()->json($apiProvider, 201);
    }

    public function update(Request $request, $id)
    {
        $apiProvider = $this->apiProviderRepository->findById($id);
        $apiProvider->update($request->all());
        $this->apiProviderRepository->save($apiProvider);
        return response()->json($apiProvider);
    }

    public function destroy($id)
    {
        $apiProvider = $this->apiProviderRepository->findById($id);
        $this->apiProviderRepository->delete($apiProvider);
        return response()->json(null, 204);
    }
}
