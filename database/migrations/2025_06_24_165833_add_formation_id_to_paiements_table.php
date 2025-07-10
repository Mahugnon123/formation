<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   /*s public function up()
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->unsignedBigInteger('formation_id')->nullable()->after('user_id');
            $table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->dropForeign(['formation_id']);
            $table->dropColumn('formation_id');
        });
    }*/
};
