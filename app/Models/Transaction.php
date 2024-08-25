<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'order_id', 'type', 'status', 'amount',
    ];

    public function user()
    {
        return $this\>belongsTo('App\Models\User');
    }

    public function order()
    {
        return $this\>belongsTo('App\Models\Order');
    }
}
