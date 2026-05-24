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
        .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin: 25px 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .section { margin-bottom: 12px; line-height: 1.8; }
        .article-title { font-weight: bold; margin-top: 12px; margin-bottom: 4px; }
        .article-content { text-align: justify; line-height: 1.7; }
        .field-label { font-weight: bold; }
        .field-value { border-bottom: 1px solid #000; }
        .indent { margin-left: 20px; }
        .signatures {
            margin-top: 30px;
            display: table;
            width: 100%;
        }
        .sig-col {
            display: table-cell;
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 10px 5px;
        }
        .sig-title { font-weight: bold; margin-bottom: 8px; font-size: 11px; }
        .sig-signed { color: green; font-size: 10px; }
        .sig-pending { color: #999; font-size: 10px; font-style: italic; }
        .sig-name { font-size: 10px; color: #555; margin-top: 5px; }
        .footer {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            text-align: center;
            font-size: 9px;
            color: #555;
            border-top: 1px solid #000;
            padding: 5px 20px;
        }
        .page-num {
            text-align: right;
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .divider { border: none; border-top: 1px solid #000; margin: 12px 0; }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <div style="text-align:center; margin-bottom:8px;">
            <span style="font-size:14px; font-weight:bold; color:#c00;">
                كلية العلــــوم والتقنيات - مراكش
            </span><br>
            <span style="font-size:13px; font-weight:bold;">FACULTÉ DES SCIENCES ET TECHNIQUES</span><br>
            <span style="font-size:11px; color:#555;">Université Cadi Ayyad — MARRAKECH</span>
        </div>
    </div>

    <div class="page-num">1/3</div>
    <div style="font-size:9px; border-bottom:1px solid #000; padding-bottom:3px; margin-bottom:10px;">
        Convention de stage FSTG/ &nbsp;&nbsp;&nbsp; -Etudiant–
    </div>

    {{-- Titre --}}
    <div class="title">CONVENTION DE STAGE</div>

    {{-- Article 1 --}}
    <div class="section">
        <p class="article-title">Article 1 : Objet de la convention</p>
        <p class="article-content">
            La présente convention de stage a pour objet de régler les rapports entre :
        </p>
        <br>
        <p>
            - La Faculté des Sciences et Techniques de Marrakech, représentée par son Doyen
            Monsieur <strong>{{ $doyen ?? 'SAID RAKRAK' }}</strong>
        </p>
        <p>Adresse &nbsp;&nbsp; : BP 549, AV. Abdelkrim El khattabi, Guéliz, Marrakech, Maroc,</p>
        <p>Téléphone : +212 524 43 34 04</p>
        <p>Fax &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: +212 524 43 31 70</p>
        <p>et désignée ci après par <strong>Etablissement</strong>.</p>
        <br>
        <p>Et</p>
        <br>
        <p>- L'Organisme ci-dessous mentionné :</p>
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
        <p>Et désigné ci-après par <strong>l'Organisme</strong>.</p>
        <br>
        <p>Elle concerne :
            <span class="field-value">
                {{ $convention->etudiant->prenom }} {{ $convention->etudiant->nom }}
            </span>
        </p>
        <p>
            Étudiant(e) régulièrement inscrit(e) dans l'établissement pour l'année universitaire
            {{ date('Y') }}/{{ date('Y') + 1 }} et dont la carte d'étudiant porte le numéro
            du Code Massar suivant : ………………………
        </p>
        <p>Et dénommé ci-après <strong>le stagiaire</strong>.</p>
    </div>

    {{-- Article 2 --}}
    <div class="section">
        <p class="article-title">Article 2 : Objectif du stage</p>
        <p class="article-content">
            Le stage de formation a pour objet de permettre à l'étudiant de mettre en pratique
            les outils théoriques et méthodologiques acquis au cours de sa formation, d'identifier
            ses compétences et de conforter son objectif professionnel.
        </p>
        <p class="article-content">
            Le stage s'inscrit dans le cadre de la formation et du projet personnel et professionnel
            de l'étudiant. Il entre dans son cursus pédagogique et est obligatoire en vue de la
            délivrance du diplôme.
        </p>
    </div>

    {{-- Article 3 --}}
    <div class="section">
        <p class="article-title">Article 3 : Lieu et période du stage</p>
        <p>
            Le stage d'une durée de
            <strong>{{ $convention->date_debut->diffInDays($convention->date_fin) }}</strong>
            jours et se déroulera du
            <strong>{{ $convention->date_debut->format('d/m/Y') }}</strong>
            au
            <strong>{{ $convention->date_fin->format('d/m/Y') }}</strong>
        </p>
        <p>Le stage aura lieu à :
            <span class="field-value">
                {{ $convention->entreprise->adresse }}
                @if($convention->service) — {{ $convention->service }} @endif
            </span>
        </p>
    </div>

    <hr class="divider">
    <div style="font-size:9px; margin-bottom:10px;">
        Convention de stage FSTG/ &nbsp;&nbsp;&nbsp; -Etudiant–
    </div>
    <div class="page-num">2/3</div>

    {{-- Article 4 --}}
    <div class="section">
        <p class="article-title">Article 4 : Statut du stagiaire – Accueil et encadrement</p>
        <p class="article-content">
            L'étudiant, pendant la durée de son stage dans l'Organisme, demeure étudiant de
            l'Établissement ; il est suivi régulièrement par l'Établissement. L'Organisme nomme
            un Encadrant chargé d'assurer le suivi technique et d'optimiser les conditions de
            réalisation du stage.
        </p>
    </div>

    {{-- Article 5 --}}
    <div class="section">
        <p class="article-title">Article 5 : Intitulé du stage</p>
        <p>Le projet de stage est intitulé :
            <span class="field-value"> {{ $convention->intitule_stage }}</span>
        </p>
        <p>Et son programme est établi en fonction de la spécialisation de l'étudiant.</p>
        <br>
        <p>Dans l'organisme d'accueil, le responsable de stage, chargé du suivi des travaux du stagiaire est :</p>
        <p>Madame/Monsieur :
            <span class="field-value"> {{ $convention->maitre_stage ?? '………………………………' }}</span>
        </p>
        <p>Qualité : <span class="field-value"> ………………………………………</span></p>
        <p>Téléphone : <span class="field-value"> ………………………</span></p>
        <p>E-mail : <span class="field-value"> {{ $convention->entreprise->email_contact }}</span></p>
        <br>
        <p>A la Faculté des Sciences et Techniques de Marrakech, le responsable de stage est :</p>
        @if($convention->encadrant)
        <p>Madame/Monsieur :
            <span class="field-value">
                {{ $convention->encadrant->prenom }} {{ $convention->encadrant->nom }}
            </span>
        </p>
        <p>Qualité : <span class="field-value"> Enseignant — {{ $convention->encadrant->specialite }}</span></p>
        @else
        <p>Madame/Monsieur : <span class="field-value"> ………………………………………</span></p>
        <p>Qualité : <span class="field-value"> ………………………………………</span></p>
        @endif
        <p>Téléphone : <span class="field-value"> ………………………</span></p>
        <p>E-mail : <span class="field-value"> ………………………………………</span></p>
    </div>

    {{-- Article 6 --}}
    <div class="section">
        <p class="article-title">Article 6 : Gratification</p>
        <p class="article-content">
            L'étudiant ne peut prétendre à rémunération, cependant il peut bénéficier d'une
            gratification. Les frais de déplacement et d'hébergement engagés par l'étudiant à
            la demande de l'Organisme, ainsi que les frais de formation éventuellement nécessités
            par le stage, seront intégralement pris en charge par l'Organisme selon les modalités
            qui y sont en vigueur.
        </p>
    </div>

    {{-- Article 7 --}}
    <div class="section">
        <p class="article-title">Article 7 : Responsabilité civile et assurances</p>
        <p class="article-content">
            Le stagiaire s'engage à se couvrir par un contrat d'assurance individuelle.
            Lorsque l'Organisme met un véhicule à la disposition du stagiaire, il lui incombe
            de vérifier préalablement que la police d'assurance du véhicule couvre son
            utilisation par un étudiant.
        </p>
    </div>

    {{-- Article 8 --}}
    <div class="section">
        <p class="article-title">Article 8 : Discipline</p>
        <p class="article-content">
            Durant son stage, l'étudiant est soumis à la discipline et au règlement intérieur
            de l'Organisme, notamment en ce qui concerne les horaires, et les règles d'hygiène
            et de sécurité en vigueur dans l'Organisme. Toute sanction disciplinaire ne peut
            être décidée que par l'Établissement. Dans ce cas, l'Organisme informe l'Établissement
            des manquements et lui fournit éventuellement les éléments constitutifs. En cas de
            manquement particulièrement grave à la discipline, l'Organisme se réserve le droit
            de mettre fin au stage de l'étudiant tout en respectant les dispositions fixées à
            l'article 10 de la présente convention.
        </p>
    </div>

    {{-- Article 9 --}}
    <div class="section">
        <p class="article-title">Article 9 : Fin de stage – Rapport – Evaluation</p>
        <p class="article-content">
            A l'issue du stage, l'Organisme délivre au stagiaire une attestation de stage et
            remplit une fiche d'évaluation qu'il retourne à l'Établissement. Selon les règlements
            pédagogiques en vigueur, l'étudiant sera susceptible de fournir un rapport. Ce rapport
            ainsi que les éventuels travaux associés pourront être présentés lors d'une soutenance.
        </p>
    </div>

    {{-- Article 10 --}}
    <div class="section">
        <p class="article-title">Article 10 : Absence et Interruption du stage</p>
        <p class="article-content">
            Au cours du stage, le stagiaire pourra bénéficier de congés sous réserve que la durée
            minimale du stage soit respectée. Pour toute autre interruption temporaire du stage
            (maladie, maternité, absence injustifiée…) l'Organisme avertira le Responsable de
            l'Établissement par courrier.
        </p>
    </div>

    {{-- Article 11 --}}
    <div class="section">
        <p class="article-title">Article 11 : Devoir de réserve et confidentialité</p>
        <p class="article-content">
            Le devoir de réserve est de rigueur absolue. Les étudiants stagiaires prennent donc
            l'engagement de n'utiliser en aucun cas les informations recueillies ou obtenues par
            eux pour en faire l'objet de publication, communication à des tiers sans accord
            préalable de la Direction de l'Organisme, y compris le rapport de stage. Cet engagement
            vaudra non seulement pour la durée du stage mais également après son expiration.
        </p>
    </div>

    {{-- Article 12 --}}
    <div class="section">
        <p class="article-title">Article 12 : Recrutement</p>
        <p class="article-content">
            Le stagiaire n'est lié par aucun contrat de travail avec l'organisme qui l'accueille.
            S'il advenait qu'un contrat de travail prenant effet avant la date de fin du stage soit
            signé avec l'Organisme la présente convention deviendrait caduque.
        </p>
    </div>

    {{-- Article 13 --}}
    <div class="section">
        <p class="article-title">Article 13 : Droit applicable – Tribunaux compétents</p>
        <p class="article-content">
            La présente convention est régie exclusivement par le droit marocain. Tout litige non
            résolu par voie amiable sera soumis à la compétence de la juridiction marocaine compétente.
        </p>
    </div>

    <hr class="divider">
    <div style="font-size:9px; margin-bottom:10px;">
        Convention de stage FSTG/ &nbsp;&nbsp;&nbsp; -Etudiant–
    </div>
    <div class="page-num">3/3</div>

    <p style="font-weight:bold; margin-bottom:15px;">Lu et approuvé</p>

    {{-- Signatures --}}
    <div class="signatures">
        <div class="sig-col">
            <p class="sig-title">Le stagiaire :</p>
            <p style="font-size:10px;">
                ………………, le
                @if($convention->date_signature_etudiant)
                    {{ $convention->date_signature_etudiant->format('d/m/Y') }}
                @else
                    …………
                @endif
            </p>
            @if($convention->date_signature_etudiant)
                <p class="sig-signed">✓ Signé numériquement</p>
                <p class="sig-name">
                    {{ $convention->etudiant->prenom }} {{ $convention->etudiant->nom }}
                </p>
            @else
                <p class="sig-pending">En attente</p>
            @endif
        </div>

        <div class="sig-col">
            <p class="sig-title">Le Responsable de l'Organisme d'Accueil ou son délégué,</p>
            <p style="font-size:10px;">
                ………………, le
                @if($convention->date_signature_entreprise)
                    {{ $convention->date_signature_entreprise->format('d/m/Y') }}
                @else
                    …………
                @endif
            </p>
            @if($convention->date_signature_entreprise)
                <p class="sig-signed">✓ Signé numériquement</p>
                <p class="sig-name">{{ $convention->entreprise->raison_sociale }}</p>
            @else
                <p class="sig-pending">En attente</p>
            @endif
        </div>
    </div>

    <div class="signatures" style="margin-top:20px;">
        <div class="sig-col">
            <p class="sig-title">Pour l'établissement,<br>Le Responsable de la Filière</p>
            <p style="font-size:10px;">
                ………………, le
                @if($convention->date_signature_chef)
                    {{ $convention->date_signature_chef->format('d/m/Y') }}
                @else
                    …………
                @endif
            </p>
            @if($convention->date_signature_chef)
                <p class="sig-signed">✓ Signé numériquement</p>
            @else
                <p class="sig-pending">En attente</p>
            @endif
        </div>

        <div class="sig-col">
            <p class="sig-title">Le Doyen</p>
            <p style="font-size:10px;">
                ………………, le
                @if($convention->date_signature_doyen)
                    {{ $convention->date_signature_doyen->format('d/m/Y') }}
                @else
                    …………
                @endif
            </p>
            @if($convention->date_signature_doyen)
                <p class="sig-signed">✓ Signé numériquement</p>
            @else
                <p class="sig-pending">En attente</p>
            @endif
        </div>
    </div>

    {{-- Footer --}}
    <div class="footer">
        كلية العلوم و التقنيات – شارع عبد الكريم الخطابي ص ب 549 مراكش المغرب &nbsp;|&nbsp;
        Faculté des Sciences et Techniques, Avenue Abdelkrim Khattabi BP 549 Marrakech Maroc
        Tel : 212 524 43 34 04 / 43 31 63 &nbsp; Fax : 212 524 43 31 70
    </div>

</body>
</html>