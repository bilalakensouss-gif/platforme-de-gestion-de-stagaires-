<?php
// database/migrations/xxxx_xx_xx_create_conventions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conventions', function (Blueprint $table) {
            $table->id();

            // Étudiant concerné
            $table->foreignId('etudiant_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Entreprise d'accueil
            $table->foreignId('entreprise_id')
                  ->constrained('entreprises')
                  ->onDelete('cascade');

            // Encadrant affecté (par le chef de filière)
            $table->foreignId('encadrant_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');

            // Type : stage_classique (TYPE1) ou pfe (TYPE2)
            $table->enum('type', ['stage_classique', 'pfe']);

            // État du circuit de signature
            $table->enum('etat', [
                'non_signee',
                'partiellement_signee',
                'signee'
            ])->default('non_signee');

            // Étape actuelle du circuit (1=Doyen, 2=Chef, 3=Etudiant, 4=Entreprise)
            $table->unsignedTinyInteger('etape_signature')->default(0);

            // Informations du stage
            $table->string('intitule_stage');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('service')->nullable();
            $table->string('maitre_stage')->nullable(); // responsable en entreprise

            // Dates de chaque signature
            $table->timestamp('date_signature_doyen')->nullable();
            $table->timestamp('date_signature_chef')->nullable();
            $table->timestamp('date_signature_etudiant')->nullable();
            $table->timestamp('date_signature_entreprise')->nullable();

            // Fichier PDF généré
            $table->string('fichier_pdf')->nullable();

            $table->date('date_creation');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conventions');
    }
};