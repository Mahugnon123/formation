<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reponses', function (Blueprint $table) {
            $table->foreignId('question_id')->nullable()->constrained()->onDelete('cascade');
            $table->dropColumn('reponses'); // Supprimer le champ JSON
            $table->text('text')->nullable(); // Ajouter un champ pour le texte de la réponse
            $table->boolean('is_correct')->default(false); // Ajouter un champ pour indiquer la bonne réponse
            $table->renameColumn('description', 'commentaires'); // Renommer pour correspondre au modèle
            $table->dropColumn('response_id'); // Supprimer si non nécessaire
        });

        Schema::dropIfExists('question_reponses'); // Supprimer la table pivot
    }

    public function down()
    {
        Schema::table('reponses', function (Blueprint $table) {
            $table->dropForeign(['question_id']);
            $table->dropColumn('question_id');
            $table->json('reponses')->nullable();
            $table->dropColumn('text');
            $table->dropColumn('is_correct');
            $table->renameColumn('commentaires', 'description');
            $table->integer('response_id')->nullable();
        });

        Schema::create('question_reponses', function (Blueprint $table) {
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->foreignId('reponse_id')->constrained()->onDelete('cascade');
            $table->boolean('statut')->default(false);
            $table->timestamps();
        });
    }
};