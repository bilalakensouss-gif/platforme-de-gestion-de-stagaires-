<?php
// app/Models/DemandeStage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeStage extends Model
{
    protected $table = 'demandes_stage';

    protected $fillable = [
        'chef_filiere_id',
        'filiere',
        'fichier_pdf',
        'date_depot',
    ];
    

    protected $casts = [
        'date_depot' => 'date',
    ];

    // Chef de filière qui a déposé
    public function chefFiliere()
    {
        return $this->belongsTo(User::class, 'chef_filiere_id');
    }
}