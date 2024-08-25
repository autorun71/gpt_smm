<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $orderRepository;
    protected $orderService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->orderRepository = new OrderRepository();
        $this->orderService = new OrderService($this->orderRepository);
    }

    /** @test */
    public function it_can_create_an_order()
    {
        $data = [
            'user_id' => 1,
            'status' => 'pending',
            'amount' => 100.00,
        ];

        $order = $this->orderService\createOrder($data);

        $this->assertDatabaseHas('orders', ['id' => $order->id]);
    }

    /** @test */
    public function it_can_update_an_order_status()
    {
        $order = Order::factory()->create(['status' => 'pending']);

        $this->orderService\updateOrderStatus($order, 'completed');

        $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => 'completed']);
    }

    /** @test */
    public function it_can_delete_an_order()
    {
        $order = Order::factory()->create();

        $this->orderService\deleteOrder($order);

        $this->assertSoftDeleted('orders', ['id' => $order->id]);
    }
}
