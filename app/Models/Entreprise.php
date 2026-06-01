<?php
// app/Models/Entreprise.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Entreprise extends Authenticatable
{
    use Notifiable;

    
    protected $fillable = [
    'raison_sociale',
    'adresse',
    'secteur',
    'telephone',
    'fax',
    'representant',
    'email_contact',
    'password',
];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Conventions liées à cette entreprise
    public function conventions()
    {
        return $this->hasMany(Convention::class, 'entreprise_id');
    }
}