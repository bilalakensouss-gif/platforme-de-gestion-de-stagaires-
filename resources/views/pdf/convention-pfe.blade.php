<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Convention de Stage - FST Marrakech</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 12px; color: #222; line-height: 1.5; padding: 20px; }
        .page { width: 100%; max-width: 800px; margin: 0 auto; padding: 40px; border: 1px solid #ddd; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 15px; }
        .faculty-name { font-size: 16px; font-weight: bold; text-transform: uppercase; margin-bottom: 5px; }
        .university { font-size: 13px; font-weight: bold; color: #555; }
        .doc-title { text-align: center; font-size: 20px; font-weight: bold; text-transform: uppercase; margin: 30px 0 20px; text-decoration: underline; }
        .section { margin-bottom: 20px; }
        .article { margin-bottom: 15px; text-align: justify; }
        .article-title { font-weight: bold; font-size: 12px; margin-bottom: 3px; }
        .field-group { margin-bottom: 8px; }
        .field-label { font-weight: bold; }
        .field-value { border-bottom: 1px solid #000; padding: 0 5px 1px 5px; min-width: 50px; display: inline-block; }
        .field-value-wide { border-bottom: 1px solid #000; padding: 0 5px 1px 5px; min-width: 200px; display: inline-block; }
        .signatures-table { width: 100%; margin-top: 40px; border-collapse: separate; border-spacing: 10px; }
        .sig-cell { width: 50%; vertical-align: top; text-align: center; border-top: 1px solid #ccc; padding-top: 10px; }
        .sig-title { font-weight: bold; font-size: 12px; margin-bottom: 5px; }
        .status-signed { color: green; font-size: 10px; font-weight: bold; }
        .status-pending { color: #bbb; font-size: 10px; font-style: italic; }
        .footer { margin-top: 40px; padding-top: 10px; border-top: 1px solid #999; text-align: center; font-size: 9px; color: #666; }
    </style>
</head>

<body>\\c
    <div class="page">

        <!-- En-tête -->
        <div class="header">
            <div class="faculty-name">Faculté des Sciences et Techniques</div>
            
            <div class="university">Université Cadi Ayyad - Marrakech</div>
            <div style="font-size: 10px; color: #666; margin-top: 5px;">
                BP 549, Av. Abdelkrim El Khattabi, Guéliz, Marrakech, Maroc<br>
                Tél: +212 524 43 34 04 / Fax: +212 524 43 31 70
            </div>
        </div>

        <!-- Titre -->
        <div class="doc-title">Convention de Stage</div>

        <!-- Parties -->
        <div class="section">
            <p>La présente convention est passée entre les soussignés :</p>
            <br>
            <p><strong>1. L'Etablissement d'Enseignement Supérieur</strong> :</p>
            <p>Faculté des Sciences et Techniques de Marrakech, représentée par son Doyen Monsieur <strong>{{ $doyen ?? 'SAID RAKRAK' }}</strong>.</p>
            <p>Adresse: BP 549, Av. Abdelkrim El Khattabi, Guéliz, Marrakech, Maroc</p>
            <br>
            <p><strong>2. L'Organisme d'Accueil (Entreprise)</strong> :</p>
            <div class="field-group"><span class="field-label">Raison Sociale :</span> <span class="field-value-wide">{{ $convention->entreprise->raison_sociale ?? $convention->entreprise_nom ?? '........................' }}</span></div>
            <div class="field-group"><span class="field-label">Adresse :</span> <span class="field-value-wide">{{ $convention->entreprise->adresse ?? $convention->entreprise_adresse ?? '........................' }}</span></div>
            <div class="field-group"><span class="field-label">Téléphone :</span> <span class="field-value">{{ $convention->entreprise->telephone ?? $convention->entreprise_telephone ?? '........................' }}</span></div>
            <div class="field-group"><span class="field-label">Fax :</span> <span class="field-value">{{ $convention->entreprise->fax ?? $convention->entreprise_fax ?? '........................' }}</span></div>
            <div class="field-group"><span class="field-label">Représenté par :</span> <span class="field-value-wide">{{ $convention->entreprise_representant ?? $convention->maitre_stage ?? '........................' }}</span></div>
        </div>

        <div class="section">
            <p><strong>3. Le Stagiaire</strong> :</p>
            <div class="field-group"><span class="field-label">Nom et Prénom :</span> <span class="field-value-wide">{{ $convention->etudiant->prenom }} {{ $convention->etudiant->nom }}</span></div>
            <div class="field-group"><span class="field-label">Code Massar :</span> <span class="field-value-wide">{{ $convention->etudiant->code_masar ?? '........................' }}</span></div>
            <div class="field-group"><span class="field-label">Niveau d'étude :</span> <span class="field-value">{{ $convention->niveau ?? 'Bac+5' }}</span></div>
            <div class="field-group"><span class="field-label">Filière :</span> <span class="field-value-wide">{{ $convention->filiere ?? 'Ingénierie Informatique' }}</span></div>
            <p>Etudiant(e) régulièrement inscrit(e) pour l'année universitaire {{ date('Y') }}/{{ date('Y')+1 }}</p>
        </div>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #000;">

        <!-- Article 1 -->
        <div class="section">
            <p class="article-title">Article 1 : Objet de la convention</p>
            <p class="article">La présente convention a pour objet de définir les modalités du stage professionnelle d'exécution du projet de fin d'études (PFE) effectué par le(stagiaire) au sein de l'Organisme d'Accueil.</p>
        </div>

        <!-- Article 2 -->
        <div class="section">
            <p class="article-title">Article 2 : Dispositions générales</p>
            <p class="article">Le stage s'inscrit dans le cadre de la formation du(stagiaire) et est obligatorio en vue de la délivrance du diplôme. Il permet à l'étudiant de mettre en pratique les connaissances théoriques acquises.</p>
        </div>

        <!-- Article 3 -->
        <div class="section">
            <p class="article-title">Article 3 : Durée et période du stage</p>
            <p>Le stage aura une durée de <strong>{{ $convention->date_debut->diffInDays($convention->date_fin) ?? '................' }}</strong> jours.</p>
            <p>Il se déroulera du <strong>{{ $convention->date_debut->format('d/m/Y') ?? '...............' }}</strong> au <strong>{{ $convention->date_fin->format('d/m/Y') ?? '...............' }}</strong>.</p>
        </div>

        <!-- Article 4 -->
        <div class="section">
            <p class="article-title">Article 4 : Sujet du stage</p>
            <div class="field-group"><span class="field-label">Intitulé du sujet :</span> <span class="field-value-wide">{{ $convention->intitule_stage ?? '........................' }}</span></div>
            <div class="field-group"><span class="field-label">Service / Département :</span> <span class="field-value">{{ $convention->service ?? '........................' }}</span></div>
        </div>

        <!-- Article 5 -->
        <div class="section">
            <p class="article-title">Article 5 : Encadrement</p>
            <p><strong>a) Au sein de l'Entreprise :</strong></p>
            <div class="field-group">Maître de stage : <span class="field-value-wide">{{ $convention->maitre_stage ?? '........................' }}</span></div>
            <div class="field-group">Téléphone : <span class="field-value">{{ $convention->maitre_stage_tel ?? '........................' }}</span></div>
            <div class="field-group">Email : <span class="field-value-wide">{{ $convention->maitre_stage_email ?? '........................' }}</span></div>
            
            <p><strong>b) A la Faculté :</strong></p>
            <div class="field-group">Encadrant : <span class="field-value-wide">{{ $convention->encadrant->prenom ?? '' }} {{ $convention->encadrant->nom ?? '........................' }}</span></div>
            <div class="field-group">Qualité : <span class="field-value">{{ $convention->encadrant->specialite ?? 'Enseignant-Chercheur' }}</span></div>
            <div class="field-group">Email : <span class="field-value-wide">{{ $convention->encadrant->email ?? '........................' }}</span></div>
        </div>

        <!-- Article 6 -->
        <div class="section">
            <p class="article-title">Article 6 : Horaires</p>
            <p class="article">Le(stagiaire) sera soumis aux horaires de l'Organisme d'Accueil. Il bénéficiera des mêmes facilités accordées aux employé(e)s de l'Entreprise.</p>
        </div>

        <!-- Article 7 -->
        <div class="section">
            <p class="article-title">Article 7 : Gratification</p>
            <p class="article">Le stage est non rémunéré. Toutefois, l'Organisme d'Accueil peut octroyer une gratification selon ses propres dispositions.</p>
        </div>

        <!-- Article 8 -->
        <div class="section">
            <p class="article-title">Article 8 : Responsabilité et Assurance</p>
            <p class="article">Le(stagiaire) doit être couvert par une assurance responsabilité civile individuelle. L'Entreprise décline toute responsabilité en cas d'accident survenu en dehors des lieux de stage.</p>
        </div>

        <!-- Article 9 -->
        <div class="section">
            <p class="article-title">Article 9 : Discipline</p>
            <p class="article">Le(stagiaire) doit respecter le règlement intérieur de l'Entreprise, notamment en matière d'hygiène et de sécurité. En cas de manquement grave, l'Entreprise peut mettre fin au stage.</p>
        </div>

        <!-- Article 10 -->
        <div class="section">
            <p class="article-title">Article 10 : Confidentialité</p>
            <p class="article">Le(stagiaire) s'engage à garder strictement confidentielles toutes les informations relatives à l'Entreprise et à ne pas les utiliser à des fins personnelles ou de publication sans accord préalable.</p>
        </div>

        <!-- Article 11 -->
        <div class="section">
            <p class="article-title">Article 11 : Rapports et Evaluation</p>
            <p class="article">A la fin du stage, l'Entreprise remettra au(stagiaire) une attestation de stage et une fiche d'évaluation. Le(stagiaire) devra remettre un rapport de stage à la Faculté.</p>
        </div>

        <!-- Article 12 -->
        <div class="section">
            <p class="article-title">Article 12 : Interruption du stage</p>
            <p class="article">En cas d'interruption pour raison médicale ou tout autre motif légitime, la présente convention sera suspenduelimited Upon resume of the stage, a new attestation will be delivered.</p>
        </div>

        <!-- Article 13 -->
        <div class="section">
            <p class="article-title">Article 13 : Droit applicable</p>
            <p class="article">La présente convention est régie par le droit marocain. Tout litige sera soumis aux tribunaux compétents du Maroc.</p>
        </div>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #000;">

        <!-- Signatures -->
        <p style="text-align: center; font-style: italic; margin-bottom: 20px;">Lu et approuvé</p>
        
        <table class="signatures-table">
            <tr>
                <td class="sig-cell">
                    <div class="sig-title">Le Stagiaire</div>
                    <span class="sig-date">Marrakech, le {{ $convention->date_signature_etudiant ?? '............' }}</span>
                    @if($convention->date_signature_etudiant)
                        <div class="status-signed">✓ Signé numériquement</div>
                    @else
                        <div class="status-pending">En attente de signature</div>
                    @endif
                </td>
                <td class="sig-cell">
                    <div class="sig-title">L'Organisme d'Accueil</div>
                    <span class="sig-date">Marrakech, le {{ $convention->date_signature_entreprise ?? '............' }}</span>
                    @if($convention->date_signature_entreprise)
                        <div class="status-signed">✓ Signé numériquement</div>
                    @else
                        <div class="status-pending">En attente de signature</div>
                    @endif
                </td>
            </tr>
            <tr>
                <td class="sig-cell">
                    <div class="sig-title">Le Responsable de Filière</div>
                    <span class="sig-date">Marrakech, le {{ $convention->date_signature_chef ?? '............' }}</span>
                    @if($convention->date_signature_chef)
                        <div class="status-signed">✓ Signé numériquement</div>
                    @else
                        <div class="status-pending">En attente de signature</div>
                    @endif
                </td>
                <td class="sig-cell">
                    <div class="sig-title">Le Doyen</div>
                    <span class="sig-date">Marrakech, le {{ $convention->date_signature_doyen ?? '............' }}</span>
                    @if($convention->date_signature_doyen)
                        <div class="status-signed">✓ Signé numériquement</div>
                    @else
                        <div class="status-pending">En attente de signature</div>
                    @endif
                </td>
            </tr>
        </table>

        <div class="footer">
            BP 549, Av. Abdelkrim El Khattabi, Guéliz, Marrakech - Tél: +212 524 43 34 04 - Fax: +212 524 43 31 70
        </div>
    </div>
</body>
</html>