<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use Illuminate\Support\Str;

class AddDescriptionToCategoriesTable extends Migration
{
     public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
           
            $table->text('description')->nullable()->after('nom'); // Ou après 'nom' ou 'user_slug'
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}