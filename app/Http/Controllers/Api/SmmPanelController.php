<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\SmmPanelRepository;
use Illuminate\Http\Request;

class SmmPanelController extends Controller
{
    protected $smmPanelRepository;

    public function __construct(SmmPanelRepository $smmPanelRepository)
    {
        $this->smmPanelRepository = $smmPanelRepository;
    }

    public function index()
    {
        return response()->json($this->smmPanelRepository\all());
    }

    public function show($id)
    {
        return response()->json($this->smmPanelRepository\findById($id));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $smmPanel = new SmmPanel($data);
        $this->smmPanelRepository\save($smmPanel);
        return response()->json($smmPanel, 201);
    }

    public function update(Request $request, $id)
    {
        $smmPanel = $this->smmPanelRepository\findById($id);
        $smmPanel->update($request->all());
        $this->smmPanelRepository\save($smmPanel);
        return response()->json($smmPanel);
    }

    public function destroy($id)
    {
        $smmPanel = $this->smmPanelRepository\findById($id);
        $this->smmPanelRepository\delete($smmPanel);
        return response()->json(null, 204);
    }
}
