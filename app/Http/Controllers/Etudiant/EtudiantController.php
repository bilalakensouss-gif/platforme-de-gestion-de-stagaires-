<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use App\Models\DemandeStage;
use App\Models\Convention;
use App\Models\Entreprise;
use App\Models\Rapport;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\GanttTask;

use Illuminate\Support\Facades\Storage;

class EtudiantController extends Controller
{
    // =====================
    // Dashboard
    // =====================
    public function updateGantt(Request $request, $id)
{
    $request->validate([
        'progression' => 'required|integer|min:0|max:100',
        'statut'      => 'required|in:non_commence,en_cours,termine',
    ]);

    $task = GanttTask::findOrFail($id);

    // Vérifier que la tâche appartient à cet étudiant
    Convention::where('etudiant_id', auth()->id())
              ->findOrFail($task->convention_id);

    $task->update([
        'progression' => $request->progression,
        'statut'      => $request->statut,
    ]);

    return back()->with('success', 'Progression mise à jour avec succès.');
}
   public function gantt()
{
    $convention = Convention::with(['etudiant', 'entreprise', 'encadrant'])
                            ->where('etudiant_id', auth()->id())
                            ->latest()
                            ->first();

    // ✅ ADD FALLBACK (same fix)
    if ($convention && !$convention->entreprise && $convention->entreprise_nom) {
        $convention->setRelation('entreprise', (object)[
            'raison_sociale' => $convention->entreprise_nom,
            'adresse'       => $convention->entreprise_adresse,
            'telephone'     => $convention->entreprise_telephone,
            'fax'           => $convention->entreprise_fax,
            'email_contact' => $convention->entreprise_email,
            'representant'  => $convention->entreprise_representant,
            'secteur'       => $convention->entreprise_secteur,
        ]);
    }

    $tasks = [];
    if ($convention) {
        $tasks = GanttTask::where('convention_id', $convention->id)
                          ->orderBy('ordre')
                          ->get();
    }

    return view('etudiant.gantt', compact('convention', 'tasks'));
}
   public function dashboard()
{
    $convention = Convention::with('entreprise')
                            ->where('etudiant_id', auth()->id())
                            ->latest()
                            ->first();

    $demande = DemandeStage::where('filiere', auth()->user()->filiere)
                           ->latest()
                           ->first();

    // If no related entreprise, use stored company name
    if ($convention && !$convention->entreprise && $convention->entreprise_nom) {
        // Store the name temporarily for the view
        $convention->setRelation('entreprise', (object)['raison_sociale' => $convention->entreprise_nom]);
    }

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
        'type'                   => 'required|in:stage_classique,pfe',
        'intitule_stage'         => 'required|string|max:255',
        'date_debut'             => 'required|date',
        'date_fin'               => 'required|date|after:date_debut',
        'service'                => 'nullable|string|max:255',
        'maitre_stage'           => 'nullable|string|max:255',
        // Infos entreprise
        'entreprise_nom'         => 'required|string|max:255',
        'entreprise_adresse'     => 'required|string|max:255',
        'entreprise_telephone'   => 'nullable|string|max:50',
        'entreprise_fax'         => 'nullable|string|max:50',
        'entreprise_email'       => 'required|email|max:255',
        'entreprise_representant'=> 'nullable|string|max:255',
        'entreprise_secteur'     => 'nullable|string|max:255',
    ]);

    // Vérifier si une entreprise avec cet email existe déjà
    $entreprise = \App\Models\Entreprise::where('email_contact',
                                                $request->entreprise_email)
                                        ->first();

    $convention = Convention::create([
        'etudiant_id'             => auth()->id(),
        'entreprise_id'           => $entreprise?->id,
        'type'                    => $request->type,
        'intitule_stage'          => $request->intitule_stage,
        'date_debut'              => $request->date_debut,
        'date_fin'                => $request->date_fin,
        'service'                 => $request->service,
        'maitre_stage'            => $request->maitre_stage,
        // Infos entreprise
        'entreprise_nom'          => $request->entreprise_nom,
        'entreprise_adresse'      => $request->entreprise_adresse,
        'entreprise_telephone'    => $request->entreprise_telephone,
        'entreprise_fax'          => $request->entreprise_fax,
        'entreprise_email'        => $request->entreprise_email,
        'entreprise_representant' => $request->entreprise_representant,
        'entreprise_secteur'      => $request->entreprise_secteur,
        'etat'                    => 'non_signee',
        'etape_signature'         => 0,
        'date_creation'           => now(),
    ]);

    // Créer les tâches Gantt
    $tachesDefaut = [
        ['titre' => 'Intégration & découverte de l\'entreprise', 'ordre' => 1],
        ['titre' => 'Visite et étude des postes sources', 'ordre' => 2],
        ['titre' => 'Dimensionnement', 'ordre' => 3],
        ['titre' => 'Étude BT', 'ordre' => 4],
        ['titre' => 'Suivi & rédaction du rapport', 'ordre' => 5],
        ['titre' => 'Préparation soutenance', 'ordre' => 6],
    ];

    foreach ($tachesDefaut as $tache) {
        GanttTask::create([
            'convention_id' => $convention->id,
            'etudiant_id'   => auth()->id(),
            'titre'         => $tache['titre'],
            'date_debut'    => $request->date_debut,
            'date_fin'      => $request->date_fin,
            'progression'   => 0,
            'statut'        => 'non_commence',
            'ordre'         => $tache['ordre'],
        ]);
    }

    ActivityLog::log('user', auth()->id(), 'creation_convention');

    return redirect()->route('etudiant.convention')
                     ->with('success', 'Convention créée. En attente de traitement par l\'administration.');
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