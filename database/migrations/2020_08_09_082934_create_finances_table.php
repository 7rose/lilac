<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->decimal('fee', 8, 2);
            $table->timestamp('date');
            $table->string('for'); 
            $table->jsonb('from')->nullable();
            $table->jsonb('to')->nullable(); 
            $table->string('type'); # 支出, 接收, 收入
            $table->boolean('invoice')->default(false);
            $table->boolean('contract')->default(false);
            $table->string('content')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->boolean('abandon')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finances');
    }
}
