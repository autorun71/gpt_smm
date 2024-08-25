<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use App\Services\TransactionService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $transactionRepository;
    protected $transactionService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->transactionRepository = new TransactionRepository();
        $this->transactionService = new TransactionService($this->transactionRepository);
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

        $transaction = $this->transactionService\createTransaction($data);

        $this->assertDatabaseHas('transactions', ['id' => $transaction->id]);
    }

    /** @test */
    public function it_can_update_a_transaction_status()
    {
        $transaction = Transaction::factory()->create(['status' => 'pending']);

        $this->transactionService\updateTransactionStatus($transaction, 'completed');

        $this->assertDatabaseHas('transactions', ['id' => $transaction->id, 'status' => 'completed']);
    }

    /** @test */
    public function it_can_delete_a_transaction()
    {
        $transaction = Transaction::factory()->create();

        $this->transactionService\deleteTransaction($transaction);

        $this->assertSoftDeleted('transactions', ['id' => $transaction->id]);
    }
}
