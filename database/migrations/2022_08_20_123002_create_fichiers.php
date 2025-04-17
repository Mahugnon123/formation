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
        Schema::create('fichiers', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('fichier_url');
            $table->string('commentaires');
            $table->morphs('fichierable');
            $table->unsignedBigInteger('typeFichier_id');
            $table->foreign('typeFichier_id')->references('id')->on('type_fichiers');
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
        Schema::dropIfExists('fichiers');
    }
};
