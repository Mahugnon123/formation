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
        Schema::table('formations', function (Blueprint $table) {
            //$table->unsignedBigInteger('fichier_id');
            //$table->foreign('fichier_id')->references('id')->on('fichiers');
            //$table->unsignedBigInteger('paiement_id');
            //$table->foreign('paiement_id')->references('id')->on('paiements');
            /*$table->unsignedBigInteger('ressource_id');
            $table->foreign('ressource_id')->references('id')->on('ressources');*/
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formations', function (Blueprint $table) {
            //
        });
    }
};
