<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'status', 'amount',
    ];

    public function user()
    {
        return $this\>belongsTo('App\Models\User');
    }

    public function transactions()
    {
        return $this\>hasMany('App\Models\Transaction');
    }
}
