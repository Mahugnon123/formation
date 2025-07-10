<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('paiements', function (Blueprint $table) {
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('transaction_id')->nullable();
        $table->unsignedBigInteger('formation_id')->nullable()->after('user_id');
        $table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('paiements', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn(['user_id', 'transaction_id', 'formation_id']);
    });
}

};
