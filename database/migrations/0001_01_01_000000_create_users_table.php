<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Informations communes
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(); // requis par Breeze
            $table->string('password');

            // Rôle
            $table->enum('role', [
                'etudiant',
                'chef_filiere',
                'doyen',
                'encadrant',
            ])->default('etudiant');

            // Filière (pour étudiant et chef de filière)
            $table->string('filiere')->nullable();

            // Spécialité (pour encadrant)
            $table->string('specialite')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};