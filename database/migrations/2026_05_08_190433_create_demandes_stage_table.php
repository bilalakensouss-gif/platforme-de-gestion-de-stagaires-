<?php
// database/migrations/xxxx_xx_xx_create_demandes_stage_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demandes_stage', function (Blueprint $table) {
            $table->id();

            // Le chef de filière qui a déposé la demande
            $table->foreignId('chef_filiere_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // La filière concernée
            $table->string('filiere');

            // Fichier PDF de la demande
            $table->string('fichier_pdf');

            $table->date('date_depot');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demandes_stage');
    }
};