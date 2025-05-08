<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_requests', function (Blueprint $table) {
            $table->id();
            $table->string('nom_complet');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('telephone');
            $table->text('domaines_expertise');
            $table->string('linkedin')->nullable();
            $table->text('presentation');
            $table->text('motivation');
            $table->string('cv_path');
            $table->string('lettre_motivation_path');
            $table->string('piece_identite_path');
            $table->json('certificats_paths')->nullable(); // Pour stocker les chemins des multiples certificats en JSON
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
        Schema::dropIfExists('partner_requests');
    }
}