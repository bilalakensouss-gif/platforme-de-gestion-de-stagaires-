<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 20px;

        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 20px;
            margin: 0;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0 0;
            color: #666;
        }
        .logos {
            
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }
        .logo-left {
            display: table-cell;
            width: 50%;
            text-align: left;
        }
        .logo-right {
            display: table-cell;
            width: 50%;
            text-align: right;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 13px;
            font-weight: bold;
            background-color: #f0f0f0;
            padding: 5px 10px;
            border-left: 4px solid #333;
            margin-bottom: 10px;
        }
        .grid {
            display: table;
            width: 100%;
        }
        .col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 10px;
        }
        .field {
            margin-bottom: 8px;
        }
        .field-label {
            color: #666;
            font-size: 11px;
        }
        .field-value {
            font-weight: bold;
        }
        .signatures {
            margin-top: 40px;
            display: table;
            width: 100%;
        }
        .signature-box {
            display: table-cell;
            width: 25%;
            text-align: center;
            border: 1px solid #ccc;
            padding: 15px 10px;
            margin: 5px;
        }
        .signature-title {
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 10px;
        }
        .signature-date {
            font-size: 10px;
            color: #666;
            margin-top: 5px;
        }
        .signed {
            color: green;
            font-size: 11px;
        }
        .not-signed {
            color: #ccc;
            font-size: 11px;
        }
        .circuit {
            margin-top: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }
        .etat-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }
        .etat-signee {
            background-color: #d4edda;
            color: #155724;
        }
        .etat-partielle {
            background-color: #fff3cd;
            color: #856404;
        }
        .etat-non {
            background-color: #f8d7da;
            color: #721c24;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    {{-- En-tête --}}
    <div class="header">
        <div class="logos">
            <div class="logo-left">
                <strong>Faculté des Sciences et Techniques</strong><br>
                <small>Université Cadi Ayyad — Marrakech</small>
            </div>
            <div class="logo-right">
                <strong>{{ $convention->entreprise->raison_sociale }}</strong><br>
                <small>{{ $convention->entreprise->secteur }}</small>
            </div>
        </div>
        <h1>Convention de Stage</h1>
        <p>
            {{ $convention->type === 'stage_classique'
                ? 'Stage Classique — TYPE 1'
                : 'Projet de Fin d\'Études (PFE) — TYPE 2' }}
        </p>
        <p>
            État :
            @if($convention->etat === 'signee')
                <span class="etat-badge etat-signee">Signée ✓</span>
            @elseif($convention->etat === 'partiellement_signee')
                <span class="etat-badge etat-partielle">En cours de signature</span>
            @else
                <span class="etat-badge etat-non">Non signée</span>
            @endif
        </p>
    </div>

    {{-- Informations étudiant --}}
    <div class="section">
        <div class="section-title">1. Informations de l'étudiant</div>
        <div class="grid">
            <div class="col">
                <div class="field">
                    <div class="field-label">Nom complet</div>
                    <div class="field-value">
                        {{ $convention->etudiant->prenom }} {{ $convention->etudiant->nom }}
                    </div>
                </div>
                <div class="field">
                    <div class="field-label">Filière</div>
                    <div class="field-value">{{ $convention->etudiant->filiere }}</div>
                </div>
            </div>
            <div class="col">
                <div class="field">
                    <div class="field-label">Email</div>
                    <div class="field-value">{{ $convention->etudiant->email }}</div>
                </div>
                @if($convention->encadrant)
                <div class="field">
                    <div class="field-label">Encadrant pédagogique</div>
                    <div class="field-value">
                        {{ $convention->encadrant->prenom }} {{ $convention->encadrant->nom }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Informations entreprise --}}
    <div class="section">
        <div class="section-title">2. Informations de l'entreprise d'accueil</div>
        <div class="grid">
            <div class="col">
                <div class="field">
                    <div class="field-label">Raison sociale</div>
                    <div class="field-value">{{ $convention->entreprise->raison_sociale }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Secteur d'activité</div>
                    <div class="field-value">{{ $convention->entreprise->secteur }}</div>
                </div>
            </div>
            <div class="col">
                <div class="field">
                    <div class="field-label">Adresse</div>
                    <div class="field-value">{{ $convention->entreprise->adresse }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Email de contact</div>
                    <div class="field-value">{{ $convention->entreprise->email_contact }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Informations du stage --}}
    <div class="section">
        <div class="section-title">3. Informations du stage</div>
        <div class="grid">
            <div class="col">
                <div class="field">
                    <div class="field-label">Intitulé du stage</div>
                    <div class="field-value">{{ $convention->intitule_stage }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Date de début</div>
                    <div class="field-value">{{ $convention->date_debut->format('d/m/Y') }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Date de fin</div>
                    <div class="field-value">{{ $convention->date_fin->format('d/m/Y') }}</div>
                </div>
            </div>
            <div class="col">
                @if($convention->service)
                <div class="field">
                    <div class="field-label">Service / Département</div>
                    <div class="field-value">{{ $convention->service }}</div>
                </div>
                @endif
                @if($convention->maitre_stage)
                <div class="field">
                    <div class="field-label">Maître de stage</div>
                    <div class="field-value">{{ $convention->maitre_stage }}</div>
                </div>
                @endif
                <div class="field">
                    <div class="field-label">Durée</div>
                    <div class="field-value">
                        {{ $convention->date_debut->diffInDays($convention->date_fin) }} jours
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Circuit de signature --}}
    <div class="section">
        <div class="section-title">4. Circuit de signature numérique</div>
        <div class="signatures">
            <div class="signature-box">
                <div class="signature-title">Doyen</div>
                @if($convention->date_signature_doyen)
                    <div class="signed">✓ Signé</div>
                    <div class="signature-date">
                        {{ $convention->date_signature_doyen->format('d/m/Y') }}
                    </div>
                @else
                    <div class="not-signed">En attente</div>
                @endif
            </div>
            <div class="signature-box">
                <div class="signature-title">Chef de Filière</div>
                @if($convention->date_signature_chef)
                    <div class="signed">✓ Signé</div>
                    <div class="signature-date">
                        {{ $convention->date_signature_chef->format('d/m/Y') }}
                    </div>
                @else
                    <div class="not-signed">En attente</div>
                @endif
            </div>
            <div class="signature-box">
                <div class="signature-title">Étudiant</div>
                @if($convention->date_signature_etudiant)
                    <div class="signed">✓ Signé</div>
                    <div class="signature-date">
                        {{ $convention->date_signature_etudiant->format('d/m/Y') }}
                    </div>
                @else
                    <div class="not-signed">En attente</div>
                @endif
            </div>
            <div class="signature-box">
                <div class="signature-title">Entreprise</div>
                @if($convention->date_signature_entreprise)
                    <div class="signed">✓ Signé</div>
                    <div class="signature-date">
                        {{ $convention->date_signature_entreprise->format('d/m/Y') }}
                    </div>
                @else
                    <div class="not-signed">En attente</div>
                @endif
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="footer">
        <p>Document généré le {{ now()->format('d/m/Y à H:i') }}</p>
        <p>Plateforme de Gestion des Stagiaires — Faculté des Sciences et Techniques — Marrakech</p>
    </div>

</body>
</html>