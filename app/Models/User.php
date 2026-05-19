<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'role',
        'filiere',
        'specialite',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // =====================
    // Helpers de rôle
    // =====================
    public function isEtudiant(): bool
    {
        return $this->role === 'etudiant';
    }

    public function isChefFiliere(): bool
    {
        return $this->role === 'chef_filiere';
    }

    public function isDoyen(): bool
    {
        return $this->role === 'doyen';
    }

    public function isEncadrant(): bool
    {
        return $this->role === 'encadrant';
    }

    // =====================
    // Relations
    // =====================

    // Chef de filière → demandes déposées
    public function demandesDeposees()
    {
        return $this->hasMany(DemandeStage::class, 'chef_filiere_id');
    }

    // Étudiant → conventions créées
    public function conventions()
    {
        return $this->hasMany(Convention::class, 'etudiant_id');
    }

    // Étudiant → rapports déposés
    public function rapports()
    {
        return $this->hasMany(Rapport::class, 'etudiant_id');
    }

    // Encadrant → conventions encadrées
    public function conventionsEncadrees()
    {
        return $this->hasMany(Convention::class, 'encadrant_id');
    }
}