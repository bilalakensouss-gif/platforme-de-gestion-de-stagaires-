<?php
// database/migrations/xxxx_xx_xx_create_rapports_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rapports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('convention_id')
                  ->constrained('conventions')
                  ->onDelete('cascade');

            $table->foreignId('etudiant_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->string('fichier'); // chemin du fichier PDF déposé
            $table->date('date_depot');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rapports');
    }
};