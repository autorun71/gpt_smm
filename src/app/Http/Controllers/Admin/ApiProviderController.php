<?php

namespace App\Http\Controllers\Admin;

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
        $apiProviders = $this->apiProviderRepository->all();
        return view('admin.api_providers.index', compact('apiProviders'));
    }

    public function show($id)
    {
        $apiProvider = $this->apiProviderRepository->findById($id);
        return view('admin.api_providers.show', compact('apiProvider'));
    }

    public function create()
    {
        return view('admin.api_providers.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->apiProviderRepository->save(new ApiProvider($data));
        return redirect()->route('admin.api_providers.index');
    }

    public function edit($id)
    {
        $apiProvider = $this->apiProviderRepository->findById($id);
        return view('admin.api_providers.edit', compact('apiProvider'));
    }

    public function update(Request $request, $id)
    {
        $apiProvider = $this->apiProviderRepository->findById($id);
        $apiProvider->update($request->all());
        $this->apiProviderRepository->save($apiProvider);
        return redirect()->route('admin.api_providers.index');
    }

    public function destroy($id)
    {
        $apiProvider = $this->apiProviderRepository->findById($id);
        $this->apiProviderRepository->delete($apiProvider);
        return redirect()->route('admin.api_providers.index');
    }
}
