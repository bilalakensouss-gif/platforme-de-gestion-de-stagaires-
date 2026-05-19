<?php
// app/Models/Rapport.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    protected $fillable = [
        'convention_id',
        'etudiant_id',
        'fichier',
        'date_depot',
    ];

    protected $casts = [
        'date_depot' => 'date',
    ];

    public function convention()
    {
        return $this->belongsTo(Convention::class, 'convention_id');
    }

    public function etudiant()
    {
        return $this->belongsTo(User::class, 'etudiant_id');
    }
}