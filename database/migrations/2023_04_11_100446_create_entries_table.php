<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("raffle_id")->unsigned();
            $table->integer('ticket_no')->unique()->unsigned()->nullable();
            $table->string("name");
            $table->string("description");
            $table->timestamps();
            $table->foreign("raffle_id")->references('id')->on('raffles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
};
