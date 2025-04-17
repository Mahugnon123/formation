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
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('user_slug');
            $table->string('titre')->nullable();
            $table->string('type')->nullable();
            $table->string('image_url')->nullable();
            $table->longText('description');
            $table->string('payante_ou_non')->nullable();
            $table->string('prix_formation')->nullable();
            $table->string('prix_certification')->nullable();
            $table->json('chapitre')->nullable();  
            $table->json('Contenu')->nullable();
            $table->json('competence')->nullable();
            $table->longText('a_propos')->nullable();
            $table->string('duree')->nullable();
            $table->json('besoin')->nullable();
            $table->longText('editordata')->nullable();
            $table->string('slug');
            $table->string('status');
            $table->softDeletes('deleted_at');
            /*$table->unsignedBigInteger('test_id')->nullable();
            $table->foreign('test_id')->references('id')->on('tests');*/
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
        Schema::dropIfExists('formations');
    }
};
