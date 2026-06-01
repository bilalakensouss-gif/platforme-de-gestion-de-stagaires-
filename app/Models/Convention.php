<?php
// app/Models/Convention.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Convention extends Model
{
    protected $fillable = [
    'etudiant_id',
    'entreprise_id',
    'encadrant_id',
    'type',
    'etat',
    'etape_signature',
    'intitule_stage',
    'date_debut',
    'date_fin',
    'service',
    'maitre_stage',
    // Infos entreprise saisies par étudiant
    'entreprise_nom',
    'entreprise_adresse',
    'entreprise_telephone',
    
    'entreprise_fax',
    'entreprise_email',
    'entreprise_representant',
    'entreprise_secteur',
    // Signatures
    'date_signature_doyen',
    'date_signature_chef',
    'date_signature_etudiant',
    'date_signature_entreprise',
    'fichier_pdf',
    'date_creation',
];

    protected $casts = [
        'date_debut'                => 'date',
        'date_fin'                  => 'date',
        'date_creation'             => 'date',
        'date_signature_doyen'      => 'datetime',
        'date_signature_chef'       => 'datetime',
        'date_signature_etudiant'   => 'datetime',
        'date_signature_entreprise' => 'datetime',
    ];

    // =====================
    // Relations
    // =====================
    public function etudiant()
    {
        return $this->belongsTo(User::class, 'etudiant_id');
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }

    public function encadrant()
    {
        return $this->belongsTo(User::class, 'encadrant_id');
    }

    public function rapport()
    {
        return $this->hasOne(Rapport::class, 'convention_id');
    }

    // =====================
    // Helpers état
    // =====================
    public function estSigneeParDoyen(): bool
    {
        return !is_null($this->date_signature_doyen);
    }

    public function estSigneeParChef(): bool
    {
        return !is_null($this->date_signature_chef);
    }

    public function estSigneeParEtudiant(): bool
    {
        return !is_null($this->date_signature_etudiant);
    }

    public function estSigneeParEntreprise(): bool
    {
        return !is_null($this->date_signature_entreprise);
    }

    public function getEtatBadgeAttribute(): string
    {
        return match($this->etat) {
            'non_signee'           => '<span class="badge bg-danger">Non signée</span>',
            'partiellement_signee' => '<span class="badge bg-warning">En cours</span>',
            'signee'               => '<span class="badge bg-success">Signée</span>',
            default                => ''
        };
    }
}