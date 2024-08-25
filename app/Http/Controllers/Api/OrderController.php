<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        return response()->json($this->orderRepository\all());
    }

    public function show($id)
    {
        return response()->json($this->orderRepository\findById($id));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $order = new Order($data);
        $this->orderRepository\save($order);
        return response()->json($order, 201);
    }

    public function update(Request $request, $id)
    {
        $order = $this->orderRepository\findById($id);
        $order->update($request->all());
        $this->orderRepository\save($order);
        return response()->json($order);
    }

    public function destroy($id)
    {
        $order = $this->orderRepository\findById($id);
        $this->orderRepository\delete($order);
        return response()->json(null, 204);
    }
}
