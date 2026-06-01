<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #000;
            padding: 20px 30px;
        }
        .header {

            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;

        }
        .faculty-name {
            font-size: 14px;
            font-weight: bold;
        }

        .university-name {
            font-size: 11px;
            color: #333;
        }

        .contact-info {
            font-size: 9px;
            color: #555;
            margin-top: 5px;
        }
        .title {
            
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin: 25px 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .section {
            margin-bottom: 15px;
            line-height: 1.8;
        }
        .field-label {
            font-weight: bold;
            display: inline;
        }
        .field-value {
            display: inline;
            border-bottom: 1px solid #000;
            padding-bottom: 1px;
        }
        .article-title {
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
        }
        .article-content {
            text-align: justify;
            line-height: 1.7;
        }
        .signatures {
            margin-top: 40px;
            width: 100%;
        }
        .signatures table {
            width: 100%;
            border-collapse: collapse;
        }
        .signatures td {
            width: 33%;
            text-align: center;
            padding: 10px 5px;
            vertical-align: top;
        }
        .sig-title {
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 8px;
        }
        .sig-date {
            font-size: 10px;
            margin-bottom: 5px;
        }
        .signed {
            color: green;
            font-size: 10px;
        }
        .not-signed {
            color: #aaa;
            font-size: 10px;
            font-style: italic;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 9px;
            color: #555;
            border-top: 1px solid #000;
            padding-top: 8px;
        }
        .divider {
            border: none;
            border-top: 1px solid #000;
            margin: 15px 0;
        }
        .indent { margin-left: 20px; }
    </style>
</head>
<body>

    {{-- En-tête --}}
    <div class="header">
        <div class="faculty-name">FACULTÉ DES SCIENCES ET TECHNIQUES</div>
        <div class="university-name">Université Cadi Ayyad — MARRAKECH</div>
        <div class="contact-info">
            Faculté des Sciences et Techniques, Avenue Abdelkrim Khattabi BP 549 Marrakech Maroc
            &nbsp;|&nbsp; Tel : 212 524 43 34 04 / 43 31 63 &nbsp;|&nbsp; Fax : 212 524 43 31 70
        </div>
    </div>

    {{-- Titre --}}
    <div class="title">CONVENTION DE STAGE</div>

    {{-- Parties --}}
    <div class="section">
        <p>Entre :</p>
        <p class="indent">- d'une part :</p>
        <p>La Faculté des Sciences et Techniques de Marrakech, représentée par son Doyen
            Monsieur <strong>{{ $doyen ?? 'SAID RAKRAK' }}</strong></p>
        <p>Adresse &nbsp;&nbsp;&nbsp;: BP 524, AV. Abdelkrim El Khattabi, Guéliz, Marrakech, Maroc.</p>
        <p>Téléphone : +212 524 43 34 04</p>
        <p>Fax &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: +212 524 43 31 70</p>
        <p>Et désignée ci après par <strong>Etablissement de formation</strong>.</p>
    </div>

    <div class="section">
        <p class="indent">- Et d'autre part :</p>
        <p>
            <span class="field-label">Nom &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
            <span class="field-value">
                {{ $convention->entreprise?->raison_sociale ?? $convention->entreprise_nom }}
            </span>
        </p>
        <p>
            <span class="field-label">Adresse &nbsp;&nbsp;&nbsp;:</span>
            <span class="field-value">
                {{ $convention->entreprise?->adresse ?? $convention->entreprise_adresse }}
            </span>
        </p>
        <p>
            <span class="field-label">Téléphone :</span>
            <span class="field-value">
                {{ $convention->entreprise_telephone ?? $convention->entreprise?->telephone ?? 'A compléter' }}
            </span>
        </p>
        <p>
            <span class="field-label">Fax &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
            <span class="field-value">
                {{ $convention->entreprise_fax ?? $convention->entreprise?->fax ?? 'A compléter' }}
            </span>
        </p>
        <p>
            <span class="field-label">Représenté par :</span>
            <span class="field-value">
                {{ $convention->entreprise_representant ?? $convention->maitre_stage ?? 'A compléter' }}
            </span>
        </p>
        <p>Et désigné ci-après par <strong>l'entreprise</strong>.</p>
    </div>

    <div class="section">
        <p>Elle concerne :</p>
        <p>
            <span class="field-label">Etudiant/Etudiante :</span>
            <span class="field-value">
                {{ $convention->etudiant->prenom }} {{ $convention->etudiant->nom }}
            </span>
        </p>
        <p>
            Etudiant(e) régulièrement inscrit(e) dans l'établissement pour l'année
            universitaire {{ date('Y') }}/{{ date('Y') + 1 }} et dont la carte d'étudiant
            porte le numéro du Code Masar suivant :
            <span class="field-value">
                {{ $convention->etudiant->code_masar ?? '................................' }}
            </span>
        </p>
        <p>Et dénommé ci-après <strong>le stagiaire</strong>.</p>
    </div>

    <hr class="divider">

    <div class="section">
        <p class="article-title">Article 1 :</p>
        <p class="article-content">
            La présente convention régit les rapports des deux parties, dans le cadre
            de l'organisation de stage d'entreprise conformément aux conditions fixées
            à la présente convention.
        </p>
    </div>

    <div class="section">
        <p class="article-title">Article 2 :</p>
        <p class="article-content">
            Le programme du stage est élaboré par le personnel chargé de l'encadrement
            du stagiaire, en tenant compte du programme et de spécialité des études du
            stagiaire, ainsi que des moyens humain et matériel de l'entreprise. Cette
            dernière se réserve le droit de réorienter l'apprentissage en fonction des
            qualifications du stagiaire et du rythme de ses activités professionnelles.
        </p>
    </div>

    <div class="section">
        <p class="article-title">Article 3 :</p>
        <p class="article-content">
            Pendant le stage, le stagiaire est soumis aux usages et règlements de
            l'entreprise, notamment en matière de discipline et des horaires. En cas de
            manquement à ces règles, l'entreprise se réserve le droit de mettre fin au
            stage, après avoir prévenu l'établissement de formation.
        </p>
    </div>

    <div class="section">
        <p class="article-title">Article 4 :</p>
        <p class="article-content">
            Au terme de son stage, le stagiaire remettra un rapport de stage à
            l'entreprise si réclamé par celle-ci.
        </p>
    </div>

    <div class="section">
        <p class="article-title">Article 5 :</p>
        <p class="article-content">
            Le stagiaire s'engage à garder confidentielle toute information recueillie
            dans l'entreprise, et à n'utiliser en aucun cas ces informations pour faire
            l'objet d'une publication, communication à des tiers, conférences, sans
            l'accord préalable de l'entreprise.
        </p>
    </div>

    <div class="section">
        <p class="article-title">Article 6 :</p>
        <p class="article-content">
            Le stagiaire est tenu de souscrire une assurance pour la garantir contre
            les risques d'accident ou d'incident auxquels le stagiaire pourrait être
            exposé durant la période de son stage.
        </p>
    </div>

    <div class="section">
        <p class="article-title">Article 7 :</p>
        <p class="article-content">
            En cas de non-respect de l'une des clauses de cette convention aussi bien
            par le stagiaire, l'entreprise se réserve le droit de mettre fin à ce stage.
        </p>
    </div>

    <div class="section">
        <p class="article-title">Article 8 :</p>
        <p>
            Le stage se déroulera du
            <strong>{{ $convention->date_debut->format('d/m/Y') }}</strong>
            au
            <strong>{{ $convention->date_fin->format('d/m/Y') }}</strong>
        </p>
        @if($convention->intitule_stage)
            <p>Intitulé du stage : <strong>{{ $convention->intitule_stage }}</strong></p>
        @endif
        @if($convention->service)
            <p>Service / Département : <strong>{{ $convention->service }}</strong></p>
        @endif
    </div>

    <hr class="divider">

    {{-- Signatures --}}
    <div class="signatures">
        <table>
            <tr>
                <td>
                    <div class="sig-title">Pour l'entreprise</div>
                    <div class="sig-date">
                        {{ $convention->entreprise?->raison_sociale ?? $convention->entreprise_nom }}, le
                        @if($convention->date_signature_entreprise)
                            {{ $convention->date_signature_entreprise->format('d/m/Y') }}
                        @else
                            …/…/………
                        @endif
                    </div>
                    @if($convention->date_signature_entreprise)
                        <div class="signed">✓ Signé numériquement</div>
                    @else
                        <div class="not-signed">En attente de signature</div>
                    @endif
                </td>

                <td>
                    <div class="sig-title">Le stagiaire</div>
                    <div style="font-size:9px;">Lu et approuvé</div>
                    <div class="sig-date">
                        Marrakech, le
                        @if($convention->date_signature_etudiant)
                            {{ $convention->date_signature_etudiant->format('d/m/Y') }}
                        @else
                            …/…/………
                        @endif
                    </div>
                    @if($convention->date_signature_etudiant)
                        <div class="signed">✓ Signé numériquement</div>
                        <div style="font-size:10px; color:#333; margin-top:3px;">
                            {{ $convention->etudiant->prenom }} {{ $convention->etudiant->nom }}
                        </div>
                    @else
                        <div class="not-signed">En attente de signature</div>
                    @endif
                </td>

                <td>
                    <div class="sig-title">Le responsable de la filière</div>
                    <div class="sig-date">
                        Marrakech, le
                        @if($convention->date_signature_chef)
                            {{ $convention->date_signature_chef->format('d/m/Y') }}
                        @else
                            …/…/………
                        @endif
                    </div>
                    @if($convention->date_signature_chef)
                        <div class="signed">✓ Signé numériquement</div>
                    @else
                        <div class="not-signed">En attente de signature</div>
                    @endif
                </td>
            </tr>
        </table>

        {{-- Doyen centré --}}
        <div style="text-align:center; margin-top:20px; padding-top:15px;
                    border-top:1px solid #ddd;">
            <div class="sig-title">Le Doyen</div>
            <div class="sig-date">
                Marrakech, le
                @if($convention->date_signature_doyen)
                    {{ $convention->date_signature_doyen->format('d/m/Y') }}
                @else
                    …/…/………
                @endif
            </div>
            @if($convention->date_signature_doyen)
                <div class="signed">✓ Signé numériquement</div>
            @else
                <div class="not-signed">En attente de signature</div>
            @endif
        </div>
    </div>

    {{-- Footer --}}
    <div class="footer">
        Faculté des Sciences et Techniques, Avenue Abdelkrim Khattabi BP 549 Marrakech Maroc
        &nbsp;|&nbsp; Tel : 212 524 43 34 04 / 43 31 63 &nbsp;|&nbsp; Fax : 212 524 43 31 70
    </div>

</body>
</html>