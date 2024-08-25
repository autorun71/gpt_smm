<?php

namespace App\Repositories;

use App\Models\SmmPanel;

class SmmPanelRepository
{
    public function findById($id)
    {
        return SmmPanel::find($id);
    }

    public function save(SmmPanel $smmPanel)
    {
        $smmPanel->save();
    }

    public function delete(SmmPanel $smmPanel)
    {
        $smmPanel->delete();
    }
}
