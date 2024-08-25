<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository
{
    public function findById($id)
    {
        return Transaction::find($id);
    }

    public function save(Transaction $transaction)
    {
        $transaction->save();
    }

    public function delete(Transaction $transaction)
    {
        $transaction->delete();
    }
}
