<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->getModelInstance();
    }

    abstract protected function getModelInstance();

    public function getById($id)
    {
        return $this\>model\findOrFail($id);
    }

    public function save($model)
    {
        $model\save();
    }

    public function delete($model)
    {
        $model\delete();
    }
}
