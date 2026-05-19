<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Entreprise;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Doyen (= Administrateur)
        User::create([
            'nom'      => 'Alami',
            'prenom'   => 'Mohammed',
            'email'    => 'doyen@fst.ma',
            'password' => Hash::make('password'),
            'role'     => 'doyen',
        ]);

        // Chef de Filière
        User::create([
            'nom'      => 'Benali',
            'prenom'   => 'Fatima',
            'email'    => 'chef@fst.ma',
            'password' => Hash::make('password'),
            'role'     => 'chef_filiere',
            'filiere'  => 'Génie Informatique',
        ]);

        // Étudiant
        User::create([
            'nom'      => 'Karimi',
            'prenom'   => 'Youssef',
            'email'    => 'etudiant@fst.ma',
            'password' => Hash::make('password'),
            'role'     => 'etudiant',
            'filiere'  => 'Génie Informatique',
        ]);

        // Encadrant
        User::create([
            'nom'        => 'Idrissi',
            'prenom'     => 'Hassan',
            'email'      => 'encadrant@fst.ma',
            'password'   => Hash::make('password'),
            'role'       => 'encadrant',
            'specialite' => 'Réseaux & Systèmes',
        ]);

        // Entreprise
        Entreprise::create([
            'raison_sociale' => 'ONCF Marrakech',
            'adresse'        => 'Avenue Hassan II, Marrakech',
            'secteur'        => 'Transport',
            'email_contact'  => 'entreprise@oncf.ma',
            'password'       => Hash::make('password'),
        ]);
    }
}