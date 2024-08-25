<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_orders()
    {
        $order = Order::factory()->create();

        $response = $this->getJson('/api/orders');

        $response->assertStatus(200)
                 ->assertJsonFragment(['status' => $order->status]);
    }

    /** @test */
    public function it_can_show_an_order()
    {
        $order = Order::factory()->create();

        $response = $this->getJson("/api/orders/{$order->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['status' => $order->status]);
    }

    /** @test */
    public function it_can_create_an_order()
    {
        $data = [
            'user_id' => 1,
            'status' => 'pending',
            'amount' => 100.00,
        ];

        $response = $this->postJson('/api/orders', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['status' => 'pending']);

        $this->assertDatabaseHas('orders', ['status' => 'pending']);
    }

    /** @test */
    public function it_can_update_an_order()
    {
        $order = Order::factory()->create();

        $data = ['status' => 'completed'];

        $response = $this->putJson("/api/orders/{$order->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment(['status' => 'completed']);

        $this->assertDatabaseHas('orders', ['status' => 'completed']);
    }

    /** @test */
    public function it_can_delete_an_order()
    {
        $order = Order::factory()->create();

        $response = $this->deleteJson("/api/orders/{$order->id}");

        $response->assertStatus(204);

        $this->assertSoftDeleted('orders', ['id' => $order->id]);
    }
}
