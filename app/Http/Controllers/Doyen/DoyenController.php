<?php

namespace App\Http\Controllers\Doyen;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Entreprise;
use App\Models\Convention;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoyenController extends Controller
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
            'entreprises' => Entreprise::count(),
            'conventions' => Convention::count(),
            'signees'     => Convention::where('etat', 'signee')->count(),
        ];

        return view('doyen.dashboard', compact('stats'));
    }

    // =====================
    // Liste tous les utilisateurs
    // =====================
    public function utilisateurs()
    {
        $encadrants  = User::where('role', 'encadrant')->get();
        $chefs       = User::where('role', 'chef_filiere')->get();
        $entreprises = Entreprise::all();
        $etudiants   = User::where('role', 'etudiant')->get();

        return view('doyen.utilisateurs', compact('encadrants', 'chefs', 'entreprises', 'etudiants'));
    }

    // =====================
    // Encadrants
    // =====================
    public function createEncadrant()
    {
        return view('doyen.encadrants.create');
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

        ActivityLog::log('user', auth()->id(), 'creation_encadrant', 'user', null, $request->email);

        return redirect()->route('doyen.utilisateurs')
                         ->with('success', 'Encadrant créé avec succès.');
    }

    public function destroyEncadrant($id)
    {
        $user = User::where('role', 'encadrant')->findOrFail($id);
        $user->delete();

        return redirect()->route('doyen.utilisateurs')
                         ->with('success', 'Encadrant supprimé.');
    }

    // =====================
    // Chefs de filière
    // =====================
    public function createChef()
    {
        return view('doyen.chefs.create');
    }

    public function storeChef(Request $request)
    {
        $request->validate([
            'nom'     => 'required|string|max:255',
            'prenom'  => 'required|string|max:255',
            'email'   => 'required|email|unique:users',
            'filiere' => 'required|string|max:255',
            'password'=> 'required|min:8|confirmed',
        ]);

        User::create([
            'nom'     => $request->nom,
            'prenom'  => $request->prenom,
            'email'   => $request->email,
            'filiere' => $request->filiere,
            'password'=> Hash::make($request->password),
            'role'    => 'chef_filiere',
        ]);

        ActivityLog::log('user', auth()->id(), 'creation_chef_filiere', 'user', null, $request->email);

        return redirect()->route('doyen.utilisateurs')
                         ->with('success', 'Chef de filière créé avec succès.');
    }

    public function destroyChef($id)
    {
        $user = User::where('role', 'chef_filiere')->findOrFail($id);
        $user->delete();

        return redirect()->route('doyen.utilisateurs')
                         ->with('success', 'Chef de filière supprimé.');
    }

    // =====================
    // Entreprises
    // =====================
    public function createEntreprise()
    {
        return view('doyen.entreprises.create');
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

        ActivityLog::log('user', auth()->id(), 'creation_entreprise', 'entreprise', null, $request->email_contact);

        return redirect()->route('doyen.utilisateurs')
                         ->with('success', 'Entreprise créée avec succès.');
    }

    public function destroyEntreprise($id)
    {
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->delete();

        return redirect()->route('doyen.utilisateurs')
                         ->with('success', 'Entreprise supprimée.');
    }

    // =====================
    // Conventions
    // =====================
    public function conventions()
    {
        $conventions = Convention::with(['etudiant', 'entreprise'])
                                 ->orderBy('created_at', 'desc')
                                 ->get();

        return view('doyen.conventions', compact('conventions'));
    }

    public function signerConvention($id)
    {
        $convention = Convention::findOrFail($id);

        // Vérifier que la convention n'est pas déjà signée par le doyen
        if ($convention->date_signature_doyen) {
            return back()->with('error', 'Convention déjà signée par le Doyen.');
        }

        $convention->update([
            'date_signature_doyen' => now(),
            'etape_signature'      => 1,
            'etat'                 => 'partiellement_signee',
        ]);

        ActivityLog::log('user', auth()->id(), 'signature_doyen', 'convention', $convention->id);

        return back()->with('success', 'Convention signée avec succès.');
    }
}