<?php

namespace App\Http\Controllers\Admin;

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
        $smmPanels = $this->smmPanelRepository\all();
        return view('admin.smm_panels.index', compact('smmPanels'));
    }

    public function show($id)
    {
        $smmPanel = $this->smmPanelRepository\findById($id);
        return view('admin.smm_panels.show', compact('smmPanel'));
    }

    public function create()
    {
        return view('admin.smm_panels.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->smmPanelRepository\save(new SmmPanel($data));
        return redirect()->route('admin.smm_panels.index');
    }

    public function edit($id)
    {
        $smmPanel = $this->smmPanelRepository\findById($id);
        return view('admin.smm_panels.edit', compact('smmPanel'));
    }

    public function update(Request $request, $id)
    {
        $smmPanel = $this->smmPanelRepository\findById($id);
        $smmPanel->update($request->all());
        $this->smmPanelRepository\save($smmPanel);
        return redirect()->route('admin.smm_panels.index');
    }

    public function destroy($id)
    {
        $smmPanel = $this->smmPanelRepository\findById($id);
        $this->smmPanelRepository\delete($smmPanel);
        return redirect()->route('admin.smm_panels.index');
    }
}
