<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gantt_tasks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('convention_id')
                  ->constrained('conventions')
                  ->onDelete('cascade');

            $table->foreignId('etudiant_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->string('titre');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->unsignedTinyInteger('progression')->default(0); // 0-100%
            $table->enum('statut', ['non_commence', 'en_cours', 'termine'])->default('non_commence');
            $table->text('description')->nullable();
            $table->integer('ordre')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gantt_tasks');
    }
};