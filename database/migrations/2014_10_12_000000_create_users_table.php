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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('pseudo')->nullable();
            $table->string('photo_profil')->nullable();
            $table->enum('sex', ['M','F','A'])->default('M');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('contact')->unique()->nullable();
            $table->string('birthday')->nullable();
            $table->string('pays')->nullable();
            $table->string('role_id');
            $table->string('slug');
            $table->dateTime('last_connexion')->nullable();
            $table->json('link_info')->nullable();
            $table->longText('biographie')->nullable();
            $table->longText('a_propos')->nullable();
            $table->softDeletes('deleted_at');
            $table->rememberToken();

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
        Schema::dropIfExists('users');
    }
};
