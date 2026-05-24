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
        .logo-area {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }
        .logo-text {
            display: table-cell;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }
        .faculty-name {
            font-size: 13px;
            font-weight: bold;
            color: #c00;
        }
        .university-name {
            font-size: 11px;
            color: #555;
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
        .field-line {
            margin-bottom: 6px;
        }
        .field-label {
            font-weight: bold;
            display: inline;
        }
        .field-value {
            display: inline;
            border-bottom: 1px solid #000;
            min-width: 200px;
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
            margin-top: 30px;
            display: table;
            width: 100%;
        }
        .sig-col {
            display: table-cell;
            width: 33%;
            text-align: center;
            vertical-align: top;
            padding: 10px 5px;
        }
        .sig-title {
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 11px;
        }
        .sig-date {
            font-size: 10px;
            margin-bottom: 20px;
        }
        .sig-name {
            font-size: 10px;
            color: #555;
            margin-top: 5px;
        }
        .sig-signed {
            color: green;
            font-size: 10px;
        }
        .sig-pending {
            color: #999;
            font-size: 10px;
            font-style: italic;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 9px;
            color: #555;
            border-top: 1px solid #000;
            padding: 5px 20px;
        }
        .divider {
            border: none;
            border-top: 1px solid #000;
            margin: 15px 0;
        }
        .indent {
            margin-left: 20px;
        }
    </style>
</head>
<body>

    {{-- Header avec logo FST --}}
    <div class="header">
        <div style="text-align:center; margin-bottom:8px;">
            <span class="faculty-name">كلية العلــــوم والتقنيات - مراكش</span><br>
            <span style="font-size:13px; font-weight:bold;">FACULTÉ DES SCIENCES ET TECHNIQUES</span><br>
            <span class="university-name">Université Cadi Ayyad — MARRAKECH</span>
        </div>
        <div style="font-size:9px; color:#555;">
            Faculté des Sciences et Techniques, Avenue Abdelkrim Khattabi BP 549 Marrakech Maroc
            Tel : 212 524 43 34 04 / 43 31 63 &nbsp; Fax : 212 524 43 31 70
        </div>
    </div>

    {{-- Titre --}}
    <div class="title">CONVENTION DE STAGE</div>

    {{-- Parties --}}
    <div class="section">
        <p>Entre :</p>
        <p class="indent">- d'une part :</p>
        <p>
            La Faculté des Sciences et Techniques de Marrakech, représentée par son Doyen
            Monsieur <strong>{{ $doyen ?? 'SAID RAKRAK' }}</strong>
        </p>
        <p>Adresse &nbsp;&nbsp; : BP 524, AV. Abdelkrim El Khattabi, Guéliz, Marrakech, Maroc.</p>
        <p>Téléphone : +212 524 43 34 04</p>
        <p>Fax &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: +212 524 43 31 70</p>
        <p>Et désignée ci après par <strong>Etablissement de formation</strong>.</p>
    </div>

    <div class="section">
        <p class="indent">- Et d'autre part :</p>
        <p><span class="field-label">Nom &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
            <span class="field-value"> {{ $convention->entreprise->raison_sociale }}</span></p>
        <p><span class="field-label">Adresse &nbsp;&nbsp;&nbsp;:</span>
            <span class="field-value"> {{ $convention->entreprise->adresse }}</span></p>
        <p><span class="field-label">Téléphone :</span>
            <span class="field-value"> {{ $convention->entreprise->telephone ?? '—' }}</span></p>
        <p><span class="field-label">Fax &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
            <span class="field-value"> —</span></p>
        <p><span class="field-label">Représenté par :</span>
            <span class="field-value"> {{ $convention->maitre_stage ?? '—' }}</span></p>
        <p>Et désigné ci-après par <strong>l'entreprise</strong>.</p>
    </div>

    <div class="section">
        <p>Elle concerne :</p>
        <p><span class="field-label">Etudiant/Etudiante :</span>
            <span class="field-value">
                {{ $convention->etudiant->prenom }} {{ $convention->etudiant->nom }}
            </span>
        </p>
        <p>
            Etudiant(e) régulièrement inscrit(e) dans l'établissement pour l'année universitaire
            {{ date('Y') }}/{{ date('Y') + 1 }} et dont la carte d'étudiant porte le numéro
            du Code Masar suivant : ………………………
        </p>
        <p>Et dénommé ci-après <strong>le stagiaire</strong>.</p>
    </div>

    <hr class="divider">

    {{-- Articles --}}
    <div class="section">
        <p class="article-title">Article 1 :</p>
        <p class="article-content">
            La présente convention régit les rapports des deux parties, dans le cadre de l'organisation
            de stage d'entreprise conformément aux conditions fixées à la présente convention.
        </p>
    </div>

    <div class="section">
        <p class="article-title">Article 2 :</p>
        <p class="article-content">
            Le programme du stage est élaboré par le personnel chargé de l'encadrement du stagiaire,
            en tenant compte du programme et de spécialité des études du stagiaire, ainsi que des moyens
            humain et matériel de l'entreprise. Cette dernière se réserve le droit de réorienter
            l'apprentissage en fonction des qualifications du stagiaire et du rythme de ses activités
            professionnelles.
        </p>
    </div>

    <div class="section">
        <p class="article-title">Article 3 :</p>
        <p class="article-content">
            Pendant le stage, le stagiaire est soumis aux usages et règlements de l'entreprise,
            notamment en matière de discipline et des horaires. En cas de manquement à ces règles,
            l'entreprise se réserve le droit de mettre fin au stage, après avoir prévenu l'établissement
            de formation.
        </p>
    </div>

    <div class="section">
        <p class="article-title">Article 4 :</p>
        <p class="article-content">
            Au terme de son stage, le stagiaire remettra un rapport de stage à l'entreprise si réclamé
            par celle-ci.
        </p>
    </div>

    <div class="section">
        <p class="article-title">Article 5 :</p>
        <p class="article-content">
            Le stagiaire s'engage à garder confidentielle toute information recueillie dans l'entreprise,
            et à n'utiliser en aucun cas ces informations pour faire l'objet d'une publication,
            communication à des tiers, conférences, sans l'accord préalable de l'entreprise.
        </p>
    </div>

    <div class="section">
        <p class="article-title">Article 6 :</p>
        <p class="article-content">
            Le stagiaire est tenu de souscrire une assurance pour la garantir contre les risques
            d'accident ou d'incident auxquels le stagiaire pourrait être exposé durant la période
            de son stage.
        </p>
    </div>

    <div class="section">
        <p class="article-title">Article 7 :</p>
        <p class="article-content">
            En cas de non-respect de l'une des clauses de cette convention aussi bien par le stagiaire,
            l'entreprise se réserve le droit de mettre fin à ce stage.
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
        @if($convention->service)
        <p>Service / Département : <strong>{{ $convention->service }}</strong></p>
        @endif
        @if($convention->intitule_stage)
        <p>Intitulé du stage : <strong>{{ $convention->intitule_stage }}</strong></p>
        @endif
    </div>

    <hr class="divider">

    {{-- Signatures --}}
    <div class="signatures">
        <div class="sig-col">
            <p class="sig-title">Pour l'entreprise</p>
            <p class="sig-date">{{ $convention->entreprise->raison_sociale }}, le
                @if($convention->date_signature_entreprise)
                    {{ $convention->date_signature_entreprise->format('d/m/Y') }}
                @else
                    …/…/………
                @endif
            </p>
            @if($convention->date_signature_entreprise)
                <p class="sig-signed">✓ Signé numériquement</p>
            @else
                <p class="sig-pending">En attente de signature</p>
            @endif
        </div>

        <div class="sig-col">
            <p class="sig-title">Le stagiaire</p>
            <p style="font-size:10px;">Lu et approuvé</p>
            <p class="sig-date">Marrakech, le
                @if($convention->date_signature_etudiant)
                    {{ $convention->date_signature_etudiant->format('d/m/Y') }}
                @else
                    …/…/………
                @endif
            </p>
            @if($convention->date_signature_etudiant)
                <p class="sig-signed">✓ Signé numériquement</p>
                <p class="sig-name">
                    {{ $convention->etudiant->prenom }} {{ $convention->etudiant->nom }}
                </p>
            @else
                <p class="sig-pending">En attente de signature</p>
            @endif
        </div>

        <div class="sig-col">
            <p class="sig-title">Le responsable de la filière</p>
            <p class="sig-date">Marrakech, le
                @if($convention->date_signature_chef)
                    {{ $convention->date_signature_chef->format('d/m/Y') }}
                @else
                    …/…/………
                @endif
            </p>
            @if($convention->date_signature_chef)
                <p class="sig-signed">✓ Signé numériquement</p>
            @else
                <p class="sig-pending">En attente de signature</p>
            @endif
        </div>
    </div>

    <div style="text-align:center; margin-top:15px;">
        <p class="sig-title">Le Doyen</p>
        <p class="sig-date">Marrakech, le
            @if($convention->date_signature_doyen)
                {{ $convention->date_signature_doyen->format('d/m/Y') }}
            @else
                …/…/………
            @endif
        </p>
        @if($convention->date_signature_doyen)
            <p class="sig-signed">✓ Signé numériquement</p>
        @else
            <p class="sig-pending">En attente de signature</p>
        @endif
    </div>

    {{-- Footer --}}
    <div class="footer">
        كلية العلوم و التقنيات – شارع عبد الكريم الخطابي ص ب 549 مراكش المغرب &nbsp;|&nbsp;
        Faculté des Sciences et Techniques, Avenue Abdelkrim Khattabi BP 549 Marrakech Maroc
        Tel : 212 524 43 34 04 / 43 31 63 &nbsp; Fax : 212 524 43 31 70
    </div>

</body>
</html>