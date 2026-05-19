<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use App\Models\DemandeStage;
use App\Models\Convention;
use App\Models\Entreprise;
use App\Models\Rapport;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EtudiantController extends Controller
{
    // =====================
    // Dashboard
    // =====================
    public function dashboard()
    {
        $convention = Convention::where('etudiant_id', auth()->id())
                                ->latest()
                                ->first();

        $demande = DemandeStage::where('filiere', auth()->user()->filiere)
                               ->latest()
                               ->first();

        return view('etudiant.dashboard', compact('convention', 'demande'));
    }

    // =====================
    // Demande de stage
    // =====================
    public function demande()
    {
        $demandes = DemandeStage::where('filiere', auth()->user()->filiere)
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('etudiant.demande', compact('demandes'));
    }

    // =====================
    // Convention
    // =====================
    public function convention()
    {
        $convention = Convention::with(['entreprise', 'encadrant'])
                                ->where('etudiant_id', auth()->id())
                                ->latest()
                                ->first();

        return view('etudiant.convention', compact('convention'));
    }

    public function createConvention()
    {
        // Vérifier que l'étudiant n'a pas déjà une convention active
        $existing = Convention::where('etudiant_id', auth()->id())
                              ->whereIn('etat', ['non_signee', 'partiellement_signee'])
                              ->first();

        if ($existing) {
            return redirect()->route('etudiant.convention')
                             ->with('error', 'Vous avez déjà une convention en cours.');
        }

        $entreprises = Entreprise::all();

        return view('etudiant.convention-create', compact('entreprises'));
    }

    public function storeConvention(Request $request)
    {
        $request->validate([
            'entreprise_id'  => 'required|exists:entreprises,id',
            'type'           => 'required|in:stage_classique,pfe',
            'intitule_stage' => 'required|string|max:255',
            'date_debut'     => 'required|date',
            'date_fin'       => 'required|date|after:date_debut',
            'service'        => 'nullable|string|max:255',
            'maitre_stage'   => 'nullable|string|max:255',
        ]);

        Convention::create([
            'etudiant_id'    => auth()->id(),
            'entreprise_id'  => $request->entreprise_id,
            'type'           => $request->type,
            'intitule_stage' => $request->intitule_stage,
            'date_debut'     => $request->date_debut,
            'date_fin'       => $request->date_fin,
            'service'        => $request->service,
            'maitre_stage'   => $request->maitre_stage,
            'etat'           => 'non_signee',
            'etape_signature'=> 0,
            'date_creation'  => now(),
        ]);

        ActivityLog::log('user', auth()->id(), 'creation_convention');

        return redirect()->route('etudiant.convention')
                         ->with('success', 'Convention créée avec succès. En attente de signature du Doyen.');
    }

    public function signerConvention($id)
    {
        $convention = Convention::where('etudiant_id', auth()->id())
                                ->findOrFail($id);

        // Vérifier que le chef a déjà signé
        if (!$convention->date_signature_chef) {
            return back()->with('error', 'Le Chef de Filière doit signer avant vous.');
        }

        // Vérifier que l'étudiant n'a pas déjà signé
        if ($convention->date_signature_etudiant) {
            return back()->with('error', 'Vous avez déjà signé cette convention.');
        }

        $convention->update([
            'date_signature_etudiant' => now(),
            'etape_signature'         => 3,
            'etat'                    => 'partiellement_signee',
        ]);

        ActivityLog::log('user', auth()->id(), 'signature_etudiant', 'convention', $convention->id);

        return back()->with('success', 'Convention signée. En attente de signature de l\'entreprise.');
    }

    public function telechargerPdf($id)
    {
        $convention = Convention::with(['etudiant', 'entreprise', 'encadrant'])
                                ->where('etudiant_id', auth()->id())
                                ->findOrFail($id);

        // On génère le PDF (Phase 6)
        // Pour l'instant on retourne juste la vue
        return view('etudiant.convention-pdf', compact('convention'));
    }

    // =====================
    // Rapport
    // =====================
    public function rapport()
    {
        $convention = Convention::where('etudiant_id', auth()->id())
                                ->where('etat', 'signee')
                                ->latest()
                                ->first();

        $rapport = Rapport::where('etudiant_id', auth()->id())
                          ->latest()
                          ->first();

        return view('etudiant.rapport', compact('convention', 'rapport'));
    }

    public function storeRapport(Request $request)
    {
        $request->validate([
            'convention_id' => 'required|exists:conventions,id',
            'fichier'       => 'required|file|mimes:pdf|max:10240',
        ]);

        $path = $request->file('fichier')->store('rapports', 'public');

        Rapport::create([
            'convention_id' => $request->convention_id,
            'etudiant_id'   => auth()->id(),
            'fichier'       => $path,
            'date_depot'    => now(),
        ]);

        ActivityLog::log('user', auth()->id(), 'depot_rapport', 'convention', $request->convention_id);

        return back()->with('success', 'Rapport déposé avec succès.');
    }
}