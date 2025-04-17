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
        Schema::create('planifiers', function (Blueprint $table) {
            $table->id();
            $table->date('debut');
            $table->date('fin');
            $table->string('title');
            //$table->BigInteger('formation_id');
            //$table->foreign('formation_id')->references('id')->on('formations');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planifiers');
    }
};
