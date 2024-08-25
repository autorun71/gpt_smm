<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{
    protected function getModelInstance()
    {
        return new Order();
    }
}
