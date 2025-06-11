<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('partner_requests', function (Blueprint $table) {
           
            $table->enum('statut', ['en_attente', 'approuvé', 'rejeté'])->default('en_attente')->after('piece_identite_path');

            $table->enum('sex', ['M', 'F'])->nullable()->after('telephone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partner_requests', function (Blueprint $table) {
            
            $table->dropColumn('statut');
            $table->dropColumn('sex');
        });
    }
};