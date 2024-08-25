<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function findById($id)
    {
        return Order::find($id);
    }

    public function save(Order $order)
    {
        $order->save();
    }

    public function delete(Order $order)
    {
        $order->delete();
    }
}
