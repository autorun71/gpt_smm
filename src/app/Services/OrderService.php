<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepository;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createOrder(array $data)
    {
        $order = new Order($data);
        $this->orderRepository->save($order);
        return $order;
    }

    public function updateOrderStatus(Order $order, string $status)
    {
        $order->status = $status;
        $this->orderRepository->save($order);
    }

    public function deleteOrder(Order $order)
    {
        $this->orderRepository->delete($order);
    }
}
