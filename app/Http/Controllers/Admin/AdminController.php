<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Entreprise;
use App\Models\Convention;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // =====================
    // Dashboard
    // =====================
    public function dashboard()
    {
        $stats = [
            'etudiants'   => User::where('role', 'etudiant')->count(),
            'encadrants'  => User::where('role', 'encadrant')->count(),
            'chefs'       => User::where('role', 'chef_filiere')->count(),
            'doyens'      => User::where('role', 'doyen')->count(),
            'entreprises' => Entreprise::count(),
            'conventions' => Convention::count(),
            'signees'     => Convention::where('etat', 'signee')->count(),
            'a_traiter'   => Convention::whereNotNull('entreprise_nom')
                                       ->whereNull('entreprise_id')
                                       ->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    // =====================
    // Utilisateurs
    // =====================
    public function utilisateurs()
    {
        $encadrants  = User::where('role', 'encadrant')->get();
        $chefs       = User::where('role', 'chef_filiere')->get();
        $doyens      = User::where('role', 'doyen')->get();
        $entreprises = Entreprise::all();
        $etudiants   = User::where('role', 'etudiant')->get();

        return view('admin.utilisateurs',
            compact('encadrants', 'chefs', 'doyens', 'entreprises', 'etudiants'));
    }

    // =====================
    // Encadrants CRUD
    // =====================
    public function createEncadrant()
    {
        return view('admin.encadrants.create');
    }

    public function storeEncadrant(Request $request)
    {
        $request->validate([
            'nom'        => 'required|string|max:255',
            'prenom'     => 'required|string|max:255',
            'email'      => 'required|email|unique:users',
            'specialite' => 'required|string|max:255',
            'password'   => 'required|min:8|confirmed',
        ]);

        User::create([
            'nom'        => $request->nom,
            'prenom'     => $request->prenom,
            'email'      => $request->email,
            'specialite' => $request->specialite,
            'password'   => Hash::make($request->password),
            'role'       => 'encadrant',
        ]);

        return redirect()->route('admin.utilisateurs')
                         ->with('success', 'Encadrant créé avec succès.');
    }

    public function destroyEncadrant($id)
    {
        User::where('role', 'encadrant')->findOrFail($id)->delete();
        return redirect()->route('admin.utilisateurs')
                         ->with('success', 'Encadrant supprimé.');
    }

    // =====================
    // Chefs CRUD
    // =====================
    public function createChef()
    {
        return view('admin.chefs.create');
    }

    public function storeChef(Request $request)
    {
        $request->validate([
            'nom'      => 'required|string|max:255',
            'prenom'   => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'filiere'  => 'required|string|max:255',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'nom'      => $request->nom,
            'prenom'   => $request->prenom,
            'email'    => $request->email,
            'filiere'  => $request->filiere,
            'password' => Hash::make($request->password),
            'role'     => 'chef_filiere',
        ]);

        return redirect()->route('admin.utilisateurs')
                         ->with('success', 'Chef de filière créé avec succès.');
    }

    public function destroyChef($id)
    {
        User::where('role', 'chef_filiere')->findOrFail($id)->delete();
        return redirect()->route('admin.utilisateurs')
                         ->with('success', 'Chef de filière supprimé.');
    }

    // =====================
    // Doyens CRUD
    // =====================
    public function createDoyen()
    {
        return view('admin.doyens.create');
    }

    public function storeDoyen(Request $request)
    {
        $request->validate([
            'nom'      => 'required|string|max:255',
            'prenom'   => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'nom'      => $request->nom,
            'prenom'   => $request->prenom,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'doyen',
        ]);

        return redirect()->route('admin.utilisateurs')
                         ->with('success', 'Doyen créé avec succès.');
    }

    public function destroyDoyen($id)
    {
        User::where('role', 'doyen')->findOrFail($id)->delete();
        return redirect()->route('admin.utilisateurs')
                         ->with('success', 'Doyen supprimé.');
    }

    // =====================
    // Entreprises CRUD
    // =====================
    public function entreprises()
    {
        $entreprises = Entreprise::all();
        return view('admin.entreprises.index', compact('entreprises'));
    }

    public function createEntreprise()
    {
        return view('admin.entreprises.create');
    }

    public function storeEntreprise(Request $request)
    {
        $request->validate([
            'raison_sociale' => 'required|string|max:255',
            'adresse'        => 'required|string|max:255',
            'secteur'        => 'nullable|string|max:255',
            'email_contact'  => 'required|email|unique:entreprises',
            'password'       => 'required|min:8|confirmed',
        ]);

        Entreprise::create([
            'raison_sociale' => $request->raison_sociale,
            'adresse'        => $request->adresse,
            'secteur'        => $request->secteur,
            'email_contact'  => $request->email_contact,
            'password'       => Hash::make($request->password),
        ]);

        return redirect()->route('admin.utilisateurs')
                         ->with('success', 'Entreprise créée avec succès.');
    }

    public function destroyEntreprise($id)
    {
        Entreprise::findOrFail($id)->delete();
        return redirect()->route('admin.utilisateurs')
                         ->with('success', 'Entreprise supprimée.');
    }

    // =====================
    // Conventions à traiter
    // — créer compte entreprise depuis infos convention
    // =====================
    public function conventions()
    {
        $conventions = Convention::with(['etudiant', 'entreprise'])
                                 ->orderBy('created_at', 'desc')
                                 ->get();

        return view('admin.conventions', compact('conventions'));
    }

    public function creerCompteEntreprise(Request $request, $id)
    {
        $convention = Convention::findOrFail($id);

        $request->validate([
            'email_contact' => 'required|email|unique:entreprises',
            'password'      => 'required|min:8|confirmed',
        ]);

        // Créer le compte entreprise avec les infos de la convention
        $entreprise = Entreprise::create([
            'raison_sociale' => $convention->entreprise_nom,
            'adresse'        => $convention->entreprise_adresse,
            'secteur'        => $convention->entreprise_secteur,
            'email_contact'  => $request->email_contact,
            'password'       => Hash::make($request->password),
        ]);

        // Lier la convention à l'entreprise
        $convention->update([
            'entreprise_id' => $entreprise->id,
        ]);

        ActivityLog::log('user', auth()->id(), 'creation_compte_entreprise',
                         'entreprise', $entreprise->id);

        return back()->with('success',
            'Compte entreprise créé. Email: ' . $request->email_contact);
    }
}