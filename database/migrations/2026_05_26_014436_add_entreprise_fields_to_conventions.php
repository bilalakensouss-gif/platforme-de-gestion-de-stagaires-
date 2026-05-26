<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Colonnes entreprise dans conventions
        Schema::table('conventions', function (Blueprint $table) {
            // Rendre entreprise_id nullable
            $table->foreignId('entreprise_id')
                  ->nullable()->change();

            if (!Schema::hasColumn('conventions', 'entreprise_nom')) {
                $table->string('entreprise_nom')->nullable()->after('entreprise_id');
            }
            if (!Schema::hasColumn('conventions', 'entreprise_adresse')) {
                $table->string('entreprise_adresse')->nullable()->after('entreprise_nom');
            }
            if (!Schema::hasColumn('conventions', 'entreprise_telephone')) {
                $table->string('entreprise_telephone')->nullable()->after('entreprise_adresse');
            }
            if (!Schema::hasColumn('conventions', 'entreprise_fax')) {
                $table->string('entreprise_fax')->nullable()->after('entreprise_telephone');
            }
            if (!Schema::hasColumn('conventions', 'entreprise_email')) {
                $table->string('entreprise_email')->nullable()->after('entreprise_fax');
            }
            if (!Schema::hasColumn('conventions', 'entreprise_representant')) {
                $table->string('entreprise_representant')->nullable()->after('entreprise_email');
            }
            if (!Schema::hasColumn('conventions', 'entreprise_secteur')) {
                $table->string('entreprise_secteur')->nullable()->after('entreprise_representant');
            }
        });

        // code_masar dans users — seulement si absent
        if (!Schema::hasColumn('users', 'code_masar')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('code_masar')->nullable()->after('filiere');
            });
        }
    }

    public function down(): void
    {
        Schema::table('conventions', function (Blueprint $table) {
            $cols = [
                'entreprise_nom', 'entreprise_adresse', 'entreprise_telephone',
                'entreprise_fax', 'entreprise_email', 'entreprise_representant',
                'entreprise_secteur',
            ];
            foreach ($cols as $col) {
                if (Schema::hasColumn('conventions', $col)) {
                    $table->dropColumn($col);
                }
            }
        });

        if (Schema::hasColumn('users', 'code_masar')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('code_masar');
            });
        }
    }
};