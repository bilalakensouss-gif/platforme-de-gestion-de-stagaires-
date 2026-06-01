<?php

namespace App\Http\Controllers\Entreprise;

use App\Http\Controllers\Controller;
use App\Models\Convention;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class EntrepriseController extends Controller
{
    // =====================
    // Dashboard
    // =====================
    public function dashboard()
    {
        $entreprise  = Auth::guard('entreprise')->user();

        $conventions = Convention::with(['etudiant'])
                                 ->where('entreprise_id', $entreprise->id)
                                 ->orderBy('created_at', 'desc')
                                 ->get();

        $stats = [
            'total'    => $conventions->count(),
            'signees'  => $conventions->where('etat', 'signee')->count(),
            'en_cours' => $conventions->where('etat', 'partiellement_signee')->count(),
            'a_signer' => $conventions->whereNull('date_signature_entreprise')
                                      ->whereNotNull('date_signature_etudiant')
                                      ->count(),
        ];

        return view('entreprise.dashboard', compact('entreprise', 'conventions', 'stats'));
    }

    // =====================
    // Convention
    // =====================
    public function convention()
    {
        $entreprise  = Auth::guard('entreprise')->user();

        $conventions = Convention::with(['etudiant', 'encadrant'])
                                 ->where('entreprise_id', $entreprise->id)
                                 ->orderBy('created_at', 'desc')
                                 ->get();

        return view('entreprise.convention', compact('conventions'));
    }

    // =====================
    // Signer la convention (étape 4)
    // =====================
    public function signerConvention($id)
    {
        $entreprise = Auth::guard('entreprise')->user();

        $convention = Convention::where('entreprise_id', $entreprise->id)
                                ->findOrFail($id);

        // Vérifier que l'étudiant a déjà signé
        if (!$convention->date_signature_etudiant) {
            return back()->with('error', 'L\'étudiant doit signer avant l\'entreprise.');
        }

        // Vérifier que l'entreprise n'a pas déjà signé
        if ($convention->date_signature_entreprise) {
            return back()->with('error', 'Vous avez déjà signé cette convention.');
        }

        $convention->update([
            'date_signature_entreprise' => now(),
            'etape_signature'           => 4,
            'etat'                      => 'signee',
        ]);

        ActivityLog::log(
            'entreprise',
            $entreprise->id,
            'signature_entreprise',
            'convention',
            $convention->id
        );

        return back()->with('success', 'Convention signée avec succès ! La convention est maintenant complète.');
    }

    
    // =====================
    // Télécharger PDF
    // =====================
    public function telechargerPdf($id)
    {
        $entreprise = Auth::guard('entreprise')->user();

        $convention = Convention::with(['etudiant', 'encadrant'])
                                ->where('entreprise_id', $entreprise->id)
                                ->findOrFail($id);

        return view('entreprise.convention-pdf', compact('convention'));
    }
}