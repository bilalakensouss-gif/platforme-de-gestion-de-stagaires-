<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EntrepriseLoginController;
use App\Http\Controllers\Doyen\DoyenController;
use App\Http\Controllers\Chef\ChefController;
use App\Http\Controllers\Etudiant\EtudiantController;
use App\Http\Controllers\Entreprise\EntrepriseController;
use App\Http\Controllers\Encadrant\EncadrantController;
use App\Http\Controllers\ConventionPdfController;

// Page d'accueil
Route::get('/', function () {
    if (auth()->check()) {
        return match(auth()->user()->role) {
            'doyen'        => redirect()->route('doyen.dashboard'),
            'chef_filiere' => redirect()->route('chef.dashboard'),
            'etudiant'     => redirect()->route('etudiant.dashboard'),
            'encadrant'    => redirect()->route('encadrant.dashboard'),
            default        => redirect()->route('login'),
        };
    }
    if (auth('entreprise')->check()) {
        return redirect()->route('entreprise.dashboard');
    }
    return view('welcome');
});

// Routes Breeze
require __DIR__.'/auth.php';

// =====================
// Auth Entreprise
// =====================
Route::get('/entreprise/login', [EntrepriseLoginController::class, 'showLoginForm'])->name('entreprise.login');
Route::post('/entreprise/login', [EntrepriseLoginController::class, 'login'])->name('entreprise.login.post');
Route::post('/entreprise/logout', [EntrepriseLoginController::class, 'logout'])->name('entreprise.logout');

// =====================
// Espace Doyen
// =====================
Route::prefix('doyen')->name('doyen.')->middleware(['auth', 'role:doyen'])->group(function () {
    Route::get('/dashboard', [DoyenController::class, 'dashboard'])->name('dashboard');

    // Utilisateurs
    Route::get('/utilisateurs', [DoyenController::class, 'utilisateurs'])->name('utilisateurs');

    // Encadrants
    Route::get('/encadrants/create', [DoyenController::class, 'createEncadrant'])->name('encadrants.create');
    Route::post('/encadrants', [DoyenController::class, 'storeEncadrant'])->name('encadrants.store');
    Route::delete('/encadrants/{id}', [DoyenController::class, 'destroyEncadrant'])->name('encadrants.destroy');

    // Chefs de filière
    Route::get('/chefs/create', [DoyenController::class, 'createChef'])->name('chefs.create');
    Route::post('/chefs', [DoyenController::class, 'storeChef'])->name('chefs.store');
    Route::delete('/chefs/{id}', [DoyenController::class, 'destroyChef'])->name('chefs.destroy');

    // Entreprises
    Route::get('/entreprises/create', [DoyenController::class, 'createEntreprise'])->name('entreprises.create');
    Route::post('/entreprises', [DoyenController::class, 'storeEntreprise'])->name('entreprises.store');
    Route::delete('/entreprises/{id}', [DoyenController::class, 'destroyEntreprise'])->name('entreprises.destroy');

    // Conventions
    Route::get('/conventions', [DoyenController::class, 'conventions'])->name('conventions');
    Route::post('/conventions/{id}/signer', [DoyenController::class, 'signerConvention'])->name('conventions.signer');
    Route::get('/conventions/{id}/pdf', [ConventionPdfController::class, 'downloadDoyen'])->name('conventions.pdf');
});

// =====================
// Espace Chef de Filière
// =====================
Route::prefix('chef')->name('chef.')->middleware(['auth', 'role:chef_filiere'])->group(function () {
    Route::get('/dashboard', [ChefController::class, 'dashboard'])->name('dashboard');

    // Demandes de stage
    Route::get('/demandes', [ChefController::class, 'demandes'])->name('demandes');
    Route::post('/demandes', [ChefController::class, 'storeDemande'])->name('demandes.store');
    Route::delete('/demandes/{id}', [ChefController::class, 'destroyDemande'])->name('demandes.destroy');

    // Conventions
    Route::get('/conventions', [ChefController::class, 'conventions'])->name('conventions');
    Route::post('/conventions/{id}/signer', [ChefController::class, 'signerConvention'])->name('conventions.signer');
    Route::post('/conventions/{id}/affecter', [ChefController::class, 'affecterEncadrant'])->name('conventions.affecter');
    Route::get('/conventions/{id}/pdf', [ConventionPdfController::class, 'downloadChef'])->name('conventions.pdf');
});

// =====================
// Espace Étudiant
// =====================
Route::prefix('etudiant')->name('etudiant.')->middleware(['auth', 'role:etudiant'])->group(function () {
    Route::get('/dashboard', [EtudiantController::class, 'dashboard'])->name('dashboard');

    // Demande de stage
    Route::get('/demande', [EtudiantController::class, 'demande'])->name('demande');

    // Convention
    Route::get('/convention', [EtudiantController::class, 'convention'])->name('convention');
    Route::get('/convention/create', [EtudiantController::class, 'createConvention'])->name('convention.create');
    Route::post('/convention', [EtudiantController::class, 'storeConvention'])->name('convention.store');
    Route::post('/convention/{id}/signer', [EtudiantController::class, 'signerConvention'])->name('convention.signer');
    Route::get('/convention/{id}/pdf', [ConventionPdfController::class, 'downloadEtudiant'])->name('convention.pdf');
Route::get('/gantt', [EtudiantController::class, 'gantt'])->name('gantt');
    // Rapport
    Route::get('/rapport', [EtudiantController::class, 'rapport'])->name('rapport');
    Route::post('/rapport', [EtudiantController::class, 'storeRapport'])->name('rapport.store');
});

// =====================
// Espace Encadrant
// =====================
// =====================
// Espace Encadrant
// =====================
Route::prefix('encadrant')->name('encadrant.')->middleware(['auth', 'role:encadrant'])->group(function () {
    Route::get('/dashboard', [EncadrantController::class, 'dashboard'])->name('dashboard');
    Route::get('/etudiants', [EncadrantController::class, 'etudiants'])->name('etudiants');
    Route::get('/etudiants/{id}', [EncadrantController::class, 'etudiant'])->name('etudiant.show');
    Route::get('/gantt', [EncadrantController::class, 'gantt'])->name('gantt');

    // Mise à jour progression Gantt
    Route::post('/gantt/{id}/update', [EncadrantController::class, 'updateGantt'])->name('gantt.update');
});

// =====================
// Espace Entreprise
// =====================
Route::prefix('entreprise')->name('entreprise.')->middleware(['entreprise'])->group(function () {
    Route::get('/dashboard', [EntrepriseController::class, 'dashboard'])->name('dashboard');
    Route::get('/convention', [EntrepriseController::class, 'convention'])->name('convention');
    Route::post('/convention/{id}/signer', [EntrepriseController::class, 'signerConvention'])->name('convention.signer');
    Route::get('/convention/{id}/pdf', [ConventionPdfController::class, 'downloadEntreprise'])->name('convention.pdf');
});