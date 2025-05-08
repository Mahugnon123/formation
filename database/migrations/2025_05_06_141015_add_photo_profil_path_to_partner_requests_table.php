<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhotoProfilPathToPartnerRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partner_requests', function (Blueprint $table) {
            $table->string('photo_profil_path')->nullable()->after('piece_identite_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partner_requests', function (Blueprint $table) {
            $table->dropColumn('photo_profil_path');
        });
    }
}