<?php

namespace App\Http\Controllers\Admin;

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
        $orders = $this->orderRepository\all();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = $this->orderRepository\findById($id);
        return view('admin.orders.show', compact('order'));
    }

    public function create()
    {
        return view('admin.orders.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->orderRepository\save(new Order($data));
        return redirect()->route('admin.orders.index');
    }

    public function edit($id)
    {
        $order = $this->orderRepository\findById($id);
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = $this->orderRepository\findById($id);
        $order->update($request->all());
        $this->orderRepository\save($order);
        return redirect()->route('admin.orders.index');
    }

    public function destroy($id)
    {
        $order = $this->orderRepository\findById($id);
        $this->orderRepository\delete($order);
        return redirect()->route('admin.orders.index');
    }
}
