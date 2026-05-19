<?php
// database/migrations/xxxx_xx_xx_create_activity_logs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            // Qui a fait l'action (peut être user ou entreprise)
            $table->string('acteur_type'); // 'user' ou 'entreprise'
            $table->unsignedBigInteger('acteur_id');

            // Quelle action
            $table->string('action');
            // Exemples : 'signature_doyen', 'signature_chef',
            // 'affectation_encadrant', 'depot_rapport', 'creation_convention'

            // Sur quel objet
            $table->string('cible_type')->nullable(); // 'convention', 'rapport', etc.
            $table->unsignedBigInteger('cible_id')->nullable();

            // Détails supplémentaires
            $table->text('details')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};