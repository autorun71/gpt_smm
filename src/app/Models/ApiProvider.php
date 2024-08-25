<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApiProvider extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'api_key', 'balance', 'currency',
    ];

    public function transactions()
    {
        return $this\>hasMany('App\Models\Transaction');
    }
}
