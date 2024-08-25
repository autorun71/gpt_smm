<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_transactions()
    {
        $transaction = Transaction::factory()->create();

        $response = $this->getJson('/api/transactions');

        $response->assertStatus(200)
                 ->assertJsonFragment(['status' => $transaction->status]);
    }

    /** @test */
    public function it_can_show_a_transaction()
    {
        $transaction = Transaction::factory()->create();

        $response = $this->getJson("/api/transactions/{$transaction->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['status' => $transaction->status]);
    }

    /** @test */
    public function it_can_create_a_transaction()
    {
        $data = [
            'user_id' => 1,
            'type' => 'order',
            'status' => 'pending',
            'amount' => 100.00,
        ];

        $response = $this->postJson('/api/transactions', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['status' => 'pending']);

        $this->assertDatabaseHas('transactions', ['status' => 'pending']);
    }

    /** @test */
    public function it_can_update_a_transaction()
    {
        $transaction = Transaction::factory()->create();

        $data = ['status' => 'completed'];

        $response = $this->putJson("/api/transactions/{$transaction->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment(['status' => 'completed']);

        $this->assertDatabaseHas('transactions', ['status' => 'completed']);
    }

    /** @test */
    public function it_can_delete_a_transaction()
    {
        $transaction = Transaction::factory()->create();

        $response = $this->deleteJson("/api/transactions/{$transaction->id}");

        $response->assertStatus(204);

        $this->assertSoftDeleted('transactions', ['id' => $transaction->id]);
    }
}
