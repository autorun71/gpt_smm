<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository extends BaseRepository
{
    protected function getModelInstance()
    {
        return new Transaction();
    }
}
