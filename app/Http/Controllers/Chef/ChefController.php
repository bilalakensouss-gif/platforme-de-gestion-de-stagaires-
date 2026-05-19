<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use App\Models\DemandeStage;
use App\Models\Convention;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChefController extends Controller
{
    // =====================
    // Dashboard
    // =====================
    public function dashboard()
    {
        $filiere = auth()->user()->filiere;

        $stats = [
            'etudiants'   => User::where('role', 'etudiant')
                                 ->where('filiere', $filiere)->count(),
            'conventions' => Convention::whereHas('etudiant', function($q) use ($filiere) {
                                 $q->where('filiere', $filiere);
                             })->count(),
            'a_signer'    => Convention::whereHas('etudiant', function($q) use ($filiere) {
                                 $q->where('filiere', $filiere);
                             })->whereNotNull('date_signature_doyen')
                               ->whereNull('date_signature_chef')->count(),
        ];

        return view('chef.dashboard', compact('stats'));
    }

    // =====================
    // Demandes de stage
    // =====================
    public function demandes()
    {
        $filiere  = auth()->user()->filiere;
        $demandes = DemandeStage::where('filiere', $filiere)
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('chef.demandes', compact('demandes'));
    }

    public function storeDemande(Request $request)
    {
        $request->validate([
            'fichier_pdf' => 'required|file|mimes:pdf|max:5120',
        ]);

        $path = $request->file('fichier_pdf')
                        ->store('demandes', 'public');

        DemandeStage::create([
            'chef_filiere_id' => auth()->id(),
            'filiere'         => auth()->user()->filiere,
            'fichier_pdf'     => $path,
            'date_depot'      => now(),
        ]);

        ActivityLog::log('user', auth()->id(), 'depot_demande_stage');

        return back()->with('success', 'Demande de stage déposée avec succès.');
    }

    // =====================
    // Conventions
    // =====================
    public function conventions()
    {
        $filiere     = auth()->user()->filiere;
        $conventions = Convention::with(['etudiant', 'entreprise', 'encadrant'])
                                 ->whereHas('etudiant', function($q) use ($filiere) {
                                     $q->where('filiere', $filiere);
                                 })
                                 ->orderBy('created_at', 'desc')
                                 ->get();

        $encadrants = User::where('role', 'encadrant')->get();

        return view('chef.conventions', compact('conventions', 'encadrants'));
    }

    public function signerConvention($id)
    {
        $convention = Convention::findOrFail($id);

        // Vérifier que le doyen a déjà signé
        if (!$convention->date_signature_doyen) {
            return back()->with('error', 'Le Doyen doit signer en premier.');
        }

        // Vérifier que le chef n'a pas déjà signé
        if ($convention->date_signature_chef) {
            return back()->with('error', 'Vous avez déjà signé cette convention.');
        }

        $convention->update([
            'date_signature_chef' => now(),
            'etape_signature'     => 2,
            'etat'                => 'partiellement_signee',
        ]);

        ActivityLog::log('user', auth()->id(), 'signature_chef', 'convention', $convention->id);

        return back()->with('success', 'Convention signée avec succès.');
    }

    public function affecterEncadrant(Request $request, $id)
    {
        $request->validate([
            'encadrant_id' => 'required|exists:users,id',
        ]);

        $convention = Convention::findOrFail($id);

        $convention->update([
            'encadrant_id' => $request->encadrant_id,
        ]);

        ActivityLog::log('user', auth()->id(), 'affectation_encadrant', 'convention', $convention->id);

        return back()->with('success', 'Encadrant affecté avec succès.');
    }
    public function destroyDemande($id)
{
    $demande = DemandeStage::where('chef_filiere_id', auth()->id())
                           ->findOrFail($id);

    // Supprimer le fichier PDF du storage
    if (Storage::disk('public')->exists($demande->fichier_pdf)) {
        Storage::disk('public')->delete($demande->fichier_pdf);
    }

    $demande->delete();

    ActivityLog::log('user', auth()->id(), 'suppression_demande_stage', 'demande', $id);

    return back()->with('success', 'Demande supprimée avec succès.');
}
}