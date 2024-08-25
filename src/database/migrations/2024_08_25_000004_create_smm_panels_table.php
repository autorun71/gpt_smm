<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmmPanelsTable extends Migration
{
    public function up()
    {
        Schema::create('smm_panels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('api_key');
            $table->decimal('balance', 15, 2)->default(0);
            $table->string('currency');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('smm_panels');
    }
}
