<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Créer un compte — FST Marrakech</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy:  #0f1f3d;
            --navy2: #1a3460;
            --red:   #c0392b;
            --gold:  #e8a020;
            --gold2: #f0b429;
            --light: #f7f8fc;
            --border: #e4e8f0;
            --muted: #6b7a99;
            --green: #1a8a55;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--light);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        h1,h2,h3,h4 { font-family: 'Sora', sans-serif; }

        /* Topbar */
        .topbar {
            background: var(--navy);
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 48px;
            border-bottom: 3px solid var(--gold);
            flex-shrink: 0;
        }
        .topbar img { height: 55px; object-fit: contain; }
        .topbar-info { text-align: right; }
        .topbar-info .uni {
            font-family: 'Sora', sans-serif;
            font-size: 13px; font-weight: 700;
            color: white; display: block;
        }
        .topbar-info .addr { font-size: 11px; color: rgba(255,255,255,0.5); }

        /* Layout */
        .main {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 520px;
            min-height: calc(100vh - 70px);
        }

        /* Left panel */
        .left-panel {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 60%, #1a4a7a 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 52px;
            position: relative;
            overflow: hidden;
        }
        .left-panel::before {
            content: '';
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 48px 48px;
        }
        .left-panel::after {
            content: '';
            position: absolute;
            bottom: -100px; right: -100px;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: rgba(26,138,85,0.08);
        }
        .lp-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(26,138,85,0.15);
            border: 1px solid rgba(26,138,85,0.3);
            padding: 5px 14px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 600;
            color: #4dd894;
            margin-bottom: 28px;
            width: fit-content;
            position: relative;
            z-index: 2;
        }
        .lp-dot {
            width: 6px; height: 6px;
            background: #4dd894;
            border-radius: 50%;
            animation: blink 2s infinite;
        }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }

        .left-panel h2 {
            font-size: 36px;
            font-weight: 800;
            color: white;
            letter-spacing: -0.8px;
            line-height: 1.2;
            margin-bottom: 14px;
            position: relative;
            z-index: 2;
        }
        .left-panel h2 span { color: #4dd894; }

        .left-panel p {
            font-size: 15px;
            color: rgba(255,255,255,0.55);
            line-height: 1.8;
            max-width: 400px;
            margin-bottom: 40px;
            position: relative;
            z-index: 2;
        }

        .lp-steps {
            display: flex;
            flex-direction: column;
            gap: 0;
            position: relative;
            z-index: 2;
        }

        .lp-step {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .lp-step:last-child { border-bottom: none; }

        .lp-step-num {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            display: flex; align-items: center;
            justify-content: center;
            font-family: 'Sora', sans-serif;
            font-size: 12px;
            font-weight: 700;
            color: #4dd894;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .lp-step-text .title {
            font-family: 'Sora', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: white;
            margin-bottom: 3px;
        }
        .lp-step-text .desc {
            font-size: 12px;
            color: rgba(255,255,255,0.4);
        }

        /* Right panel */
        .right-panel {
            background: white;
            border-left: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px 44px;
            overflow-y: auto;
        }

        .form-header { margin-bottom: 28px; }

        .form-tag {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--green);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }
        .form-tag::before {
            content: '';
            display: block;
            width: 16px; height: 2px;
            background: var(--green);
            border-radius: 2px;
        }

        .form-header h2 {
            font-size: 26px;
            font-weight: 800;
            color: var(--navy);
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }
        .form-header p { font-size: 14px; color: var(--muted); }

        .alert-error {
            background: #fde8e8;
            border: 1px solid #f5c6c6;
            color: #8b1a10;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .form-group { margin-bottom: 16px; }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-family: 'Sora', sans-serif;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: 13.5px;
            color: var(--navy);
            background: var(--light);
            outline: none;
            transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
        }

        .form-input:focus, .form-select:focus {
            border-color: var(--green);
            background: white;
            box-shadow: 0 0 0 3px rgba(26,138,85,0.08);
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7a99' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px;
        }

        .btn-submit {
            width: 100%;
            padding: 13px;
            background: var(--green);
            color: white;
            border: none;
            border-radius: 8px;
            font-family: 'Sora', sans-serif;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 4px;
        }

        .btn-submit:hover {
            background: #1da863;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(26,138,85,0.25);
        }

        .form-footer {
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
            text-align: center;
        }

        .form-footer p {
            font-size: 13px;
            color: var(--muted);
        }

        .form-footer a {
            color: var(--navy);
            font-weight: 600;
            text-decoration: none;
        }

        .form-footer a:hover { color: var(--green); }

        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--muted);
            text-decoration: none;
            margin-bottom: 20px;
            transition: color 0.2s;
        }
        .back-home:hover { color: var(--navy); }

        .password-hint {
            font-size: 11px;
            color: var(--muted);
            margin-top: 4px;
        }
    </style>
</head>
<body>

    {{-- Topbar --}}
    <div class="topbar">
        <img src="{{ asset('images/logo-fst.png') }}"
             alt="FST Marrakech"
             onerror="this.style.display='none'">
        <div class="topbar-info">
            <span class="uni">Université Cadi Ayyad — Marrakech</span>
            <span class="addr">Tél : +212 524 43 34 04 | Fax : +212 524 43 31 70</span>
        </div>
    </div>

    <div class="main">

        {{-- Left panel --}}
        <div class="left-panel">
            <div class="lp-badge">
                <span class="lp-dot"></span>
                Inscription Étudiant
            </div>

            <h2>
                Créez votre<br>
                <span>compte étudiant</span>
            </h2>

            <p>
                Rejoignez la plateforme officielle de gestion des stages
                de la FST Marrakech en quelques étapes simples.
            </p>

            <div class="lp-steps">
                <div class="lp-step">
                    <div class="lp-step-num">1</div>
                    <div class="lp-step-text">
                        <div class="title">Créez votre compte</div>
                        <div class="desc">Remplissez le formulaire d'inscription</div>
                    </div>
                </div>
                <div class="lp-step">
                    <div class="lp-step-num">2</div>
                    <div class="lp-step-text">
                        <div class="title">Téléchargez la demande</div>
                        <div class="desc">Récupérez la demande de stage de votre filière</div>
                    </div>
                </div>
                <div class="lp-step">
                    <div class="lp-step-num">3</div>
                    <div class="lp-step-text">
                        <div class="title">Créez votre convention</div>
                        <div class="desc">Saisissez les informations de votre stage</div>
                    </div>
                </div>
                <div class="lp-step">
                    <div class="lp-step-num">4</div>
                    <div class="lp-step-text">
                        <div class="title">Signez et suivez</div>
                        <div class="desc">Suivez le circuit de 4 signatures en temps réel</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right panel --}}
        <div class="right-panel">

            <a href="/" class="back-home">
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none"
                     stroke="currentColor" stroke-width="2">
                    <path d="M10 3L5 8l5 5"/>
                </svg>
                Retour à l'accueil
            </a>

            <div class="form-header">
                <div class="form-tag">Inscription</div>
                <h2>Créer un compte</h2>
                <p>Réservé aux étudiants de la FST Marrakech</p>
            </div>

            @if($errors->any())
                <div class="alert-error">
                    @foreach($errors->all() as $error)
                        <p>⚠️ {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-input"
                               value="{{ old('nom') }}"
                               placeholder="Votre nom"
                               required autofocus>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-input"
                               value="{{ old('prenom') }}"
                               placeholder="Votre prénom"
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Filière</label>
                    <select name="filiere" class="form-select" required>
                        <option value="">-- Sélectionnez votre filière --</option>
                        <option value="Génie Informatique"
                            {{ old('filiere') == 'Génie Informatique' ? 'selected' : '' }}>
                            Génie Informatique
                        </option>
                        <option value="Génie Électrique"
                            {{ old('filiere') == 'Génie Électrique' ? 'selected' : '' }}>
                            Génie Électrique
                        </option>
                        <option value="Génie Civil"
                            {{ old('filiere') == 'Génie Civil' ? 'selected' : '' }}>
                            Génie Civil
                        </option>
                        <option value="Génie Mécanique"
                            {{ old('filiere') == 'Génie Mécanique' ? 'selected' : '' }}>
                            Génie Mécanique
                        </option>
                    </select>
                </div>
<div class="form-group">
    <label class="form-label">Code Masar</label>
    <input type="text" name="code_masar" class="form-input"
           value="{{ old('code_masar') }}"
           placeholder="Votre numéro Code Masar">
</div>
                <div class="form-group">
                    <label class="form-label">Adresse email</label>
                    <input type="email" name="email" class="form-input"
                           value="{{ old('email') }}"
                           placeholder="votre@email.com"
                           required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-input"
                               placeholder="••••••••" required>
                        <p class="password-hint">Minimum 8 caractères</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirmer</label>
                        <input type="password" name="password_confirmation"
                               class="form-input"
                               placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    Créer mon compte
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none"
                         stroke="currentColor" stroke-width="2.5">
                        <path d="M8 3l5 5-5 5M3 8h10"/>
                    </svg>
                </button>

            </form>

            <div class="form-footer">
                <p>
                    Déjà inscrit ?
                    <a href="{{ route('login') }}">Se connecter</a>
                </p>
            </div>

        </div>
    </div>

</body>
</html>