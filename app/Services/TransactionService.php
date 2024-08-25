<?php

namespace App\Services;

use App\Models\Transaction;
use App\Repositories\TransactionRepository;

class TransactionService
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function createTransaction(array $data)
    {
        $transaction = new Transaction($data);
        $this->transactionRepository\save($transaction);
        return $transaction;
    }

    public function updateTransactionStatus(Transaction $transaction, string $status)
    {
        $transaction->status = $status;
        $this->transactionRepository\save($transaction);
    }

    public function deleteTransaction(Transaction $transaction)
    {
        $this->transactionRepository\delete($transaction);
    }
}
