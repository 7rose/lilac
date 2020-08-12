<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamp('date');
            $table->timestamp('real_date')->nullable();
            $table->text('content')->nullable();
            $table->jsonb('parts');
            $table->jsonb('log');
            $table->bigInteger('created_by');
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
        Schema::dropIfExists('tasks');
    }
}
