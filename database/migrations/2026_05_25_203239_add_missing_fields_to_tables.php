<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ajouter champs à la table entreprises
        Schema::table('entreprises', function (Blueprint $table) {
            $table->string('telephone')->nullable()->after('secteur');
            $table->string('fax')->nullable()->after('telephone');
            $table->string('representant')->nullable()->after('fax');
        });

        // Ajouter code_masar à la table users
        Schema::table('users', function (Blueprint $table) {
            $table->string('code_masar')->nullable()->after('filiere');
        });
    }

    public function down(): void
    {
        Schema::table('entreprises', function (Blueprint $table) {
            $table->dropColumn(['telephone', 'fax', 'representant']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('code_masar');
        });
    }
};