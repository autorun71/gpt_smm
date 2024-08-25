<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')\constrained()\onDelete('cascade');
            $table->foreignId('order_id')\nullable()\constrained()\onDelete('set null');
            $table->enum('type', ['order', 'order_status', 'replenishment', 'refund', 'pay']);
            $table->enum('status', ['pending', 'completed', 'canceled', 'error']);
            $table->decimal('amount', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
