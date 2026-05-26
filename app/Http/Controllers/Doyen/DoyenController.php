<?php

namespace App\Http\Controllers\Doyen;

use App\Http\Controllers\Controller;
use App\Models\Convention;
use App\Models\ActivityLog;
use App\Models\Entreprise;
use App\Models\User;

class DoyenController extends Controller
{
    public function dashboard()
    {
        $conventions = Convention::with(['etudiant', 'entreprise'])
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'etudiants'   => User::where('role', 'etudiant')->count(),
            'encadrants'  => User::where('role', 'encadrant')->count(),
            'chefs'       => User::where('role', 'chef_filiere')->count(),
            'entreprises' => Entreprise::count(),
            'conventions' => Convention::count(),
            'a_signer'    => Convention::whereNull('date_signature_doyen')->count(),
            'signees'     => Convention::whereNotNull('date_signature_doyen')->count(),
        ];

        return view('doyen.dashboard', compact('conventions', 'stats'));
    }

    public function utilisateurs()
    {
        $utilisateurs = User::whereIn('role', ['etudiant', 'encadrant', 'chef_filiere'])
            ->orderBy('nom')  // ← corrigé : 'nom' et non 'name'
            ->get();

        return view('doyen.utilisateurs', compact('utilisateurs'));
    }

    public function conventions()
    {
        $conventions = Convention::with(['etudiant', 'entreprise', 'encadrant'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('doyen.conventions', compact('conventions'));
    }

    public function signerConvention($id)
    {
        $convention = Convention::findOrFail($id);

        if ($convention->date_signature_doyen) {
            return back()->with('error', 'Convention déjà signée par le Doyen.');
        }

        $convention->update([
            'date_signature_doyen' => now(),
            'etape_signature'      => 1,
            'etat'                 => 'partiellement_signee',
        ]);

        ActivityLog::log('user', auth()->id(), 'signature_doyen',
                         'convention', $convention->id);

        return back()->with('success', 'Convention signée avec succès.');
    }
}