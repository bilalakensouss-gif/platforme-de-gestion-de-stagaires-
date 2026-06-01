<?php

namespace App\Http\Controllers;

use App\Models\Convention;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ConventionPdfController extends Controller
{
    // =====================
    // Méthode centrale de génération
    // =====================
    private function generatePdf(Convention $convention)
    {
        // ✅ FIX: Add ALL required fields including email_contact
        if (!$convention->entreprise && $convention->entreprise_nom) {
            $convention->setRelation('entreprise', (object)[
                'raison_sociale' => $convention->entreprise_nom,
                'adresse'       => $convention->entreprise_adresse,
                'telephone'     => $convention->entreprise_telephone,
                'fax'           => $convention->entreprise_fax,
                'email_contact' => $convention->entreprise_email,  // ✅ THIS WAS MISSING
                'representant'  => $convention->entreprise_representant,
                'secteur'       => $convention->entreprise_secteur,
            ]);
        }

        // Choisir le template selon le type
        $view = $convention->type === 'stage_classique'
            ? 'pdf.convention-stage'
            : 'pdf.convention-pfe';

        // Récupérer le nom du doyen
        $doyen = User::where('role', 'doyen')->first();
        $doyenNom = $doyen ? $doyen->prenom.' '.$doyen->nom : 'SAID RAKRAK';

        $pdf = Pdf::loadView($view, [
            'convention' => $convention,
            'doyen'      => $doyenNom,
        ])->setPaper('a4', 'portrait');

        $filename = 'convention_'
            . strtolower($convention->etudiant->nom)
            . '_' . $convention->id . '.pdf';

        return $pdf->download($filename);
    }

    // PDF pour l'étudiant
    public function downloadEtudiant($id)
    {
        $convention = Convention::with(['etudiant', 'entreprise', 'encadrant'])
                                ->where('etudiant_id', auth()->id())
                                ->findOrFail($id);

        return $this->generatePdf($convention);
    }

    // PDF pour le doyen
    public function downloadDoyen($id)
    {
        $convention = Convention::with(['etudiant', 'entreprise', 'encadrant'])
                                ->findOrFail($id);

        return $this->generatePdf($convention);
    }

    // PDF pour le chef
    public function downloadChef($id)
    {
        $convention = Convention::with(['etudiant', 'entreprise', 'encadrant'])
                                ->findOrFail($id);

        return $this->generatePdf($convention);
    }

    // PDF pour l'entreprise
    public function downloadEntreprise($id)
    {
        $entreprise = Auth::guard('entreprise')->user();
        

        $convention = Convention::with(['etudiant', 'entreprise', 'encadrant'])
                                ->where('entreprise_id', $entreprise->id)
                                ->findOrFail($id);

        return $this->generatePdf($convention);
    }
}