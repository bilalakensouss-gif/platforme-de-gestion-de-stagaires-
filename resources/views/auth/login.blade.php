<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter — FST Marrakech</title>
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
        .topbar img {
            height: 55px;
            object-fit: contain;
        }
        .topbar-info {
            text-align: right;
        }
        .topbar-info .uni {
            font-family: 'Sora', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: white;
            display: block;
        }
        .topbar-info .addr {
            font-size: 11px;
            color: rgba(255,255,255,0.5);
        }

        /* Main */
        .main {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 480px;
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
            position: absolute;
            inset: 0;
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
            background: rgba(232,160,32,0.06);
        }
        .lp-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(232,160,32,0.15);
            border: 1px solid rgba(232,160,32,0.3);
            padding: 5px 14px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 600;
            color: var(--gold2);
            margin-bottom: 28px;
            width: fit-content;
            position: relative;
            z-index: 2;
        }
        .lp-dot {
            width: 6px; height: 6px;
            background: var(--gold2);
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
        .left-panel h2 span { color: var(--gold2); }

        .left-panel p {
            font-size: 15px;
            color: rgba(255,255,255,0.55);
            line-height: 1.8;
            max-width: 400px;
            margin-bottom: 40px;
            position: relative;
            z-index: 2;
        }

        .lp-features {
            display: flex;
            flex-direction: column;
            gap: 16px;
            position: relative;
            z-index: 2;
        }

        .lp-feature {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .lp-feature-icon {
            width: 42px; height: 42px;
            border-radius: 10px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.1);
            display: flex; align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .lp-feature-text .title {
            font-family: 'Sora', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: white;
            margin-bottom: 2px;
        }

        .lp-feature-text .desc {
            font-size: 12px;
            color: rgba(255,255,255,0.45);
        }

        /* Right panel - form */
        .right-panel {
            background: white;
            border-left: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 48px 44px;
        }

        .form-header {
            margin-bottom: 32px;
        }

        .form-header .form-tag {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--red);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }

        .form-tag::before {
            content: '';
            display: block;
            width: 16px; height: 2px;
            background: var(--red);
            border-radius: 2px;
        }

        .form-header h2 {
            font-size: 28px;
            font-weight: 800;
            color: var(--navy);
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .form-header p {
            font-size: 14px;
            color: var(--muted);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--navy);
            margin-bottom: 7px;
            font-family: 'Sora', sans-serif;
        }

        .form-input {
            width: 100%;
            padding: 11px 15px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            color: var(--navy);
            background: var(--light);
            outline: none;
            transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
        }

        .form-input:focus {
            border-color: var(--navy2);
            background: white;
            box-shadow: 0 0 0 3px rgba(26,52,96,0.08);
        }

        .form-input.error { border-color: var(--red); }

        .alert-error {
            background: #fde8e8;
            border: 1px solid #f5c6c6;
            color: #8b1a10;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-submit {
            width: 100%;
            padding: 13px;
            background: var(--navy);
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
            margin-top: 8px;
        }

        .btn-submit:hover {
            background: var(--navy2);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(15,31,61,0.2);
        }

        .form-footer {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .form-footer a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            border: 1.5px solid var(--border);
            color: var(--navy);
            font-family: 'Sora', sans-serif;
        }

        .form-footer a:hover {
            border-color: var(--navy);
            background: var(--light);
        }

        .form-footer a svg {
            width: 14px; height: 14px;
            opacity: 0.5;
        }

        .form-footer .entreprise-link {
            border-color: var(--red);
            color: var(--red);
            background: #fde8e8;
        }

        .form-footer .entreprise-link:hover {
            background: var(--red);
            color: white;
        }

        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--muted);
            text-decoration: none;
            margin-bottom: 24px;
            transition: color 0.2s;
        }

        .back-home:hover { color: var(--navy); }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .remember-check {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            color: var(--muted);
            cursor: pointer;
        }

        .remember-check input { accent-color: var(--navy); }
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
                Plateforme officielle FST Marrakech
            </div>

            <h2>
                Bienvenue 
            </h2>

            <p>
                Gérez vos conventions de stage, signatures numériques et
                suivi pédagogique en un seul endroit sécurisé.
            </p>

            
        </div>

        {{-- Right panel - form --}}
        <div class="right-panel">

            <a href="/" class="back-home">
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none"
                     stroke="currentColor" stroke-width="2">
                    <path d="M10 3L5 8l5 5"/>
                </svg>
                Retour à l'accueil
            </a>

            <div class="form-header">
                <div class="form-tag">Connexion</div>
                <h2>Se connecter</h2>
                <p>Accédez à votre espace personnel</p>
            </div>

            @if($errors->any())
                <div class="alert-error">
                    ⚠️ {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">Adresse email</label>
                    <input type="email"
                           name="email"
                           class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                           value="{{ old('email') }}"
                           placeholder="votre@email.com"
                           required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label">Mot de passe</label>
                    <input type="password"
                           name="password"
                           class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                           placeholder="••••••••"
                           required>
                </div>

                <div class="remember-row">
                    <label class="remember-check">
                        <input type="checkbox" name="remember">
                        Se souvenir de moi
                    </label>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           style="font-size:12px; color:var(--muted); text-decoration:none;">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn-submit">
                    Se connecter
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none"
                         stroke="currentColor" stroke-width="2.5">
                        <path d="M8 3l5 5-5 5M3 8h10"/>
                    </svg>
                </button>
            </form>

            <div class="form-footer">
                <a href="{{ route('register') }}">
                    Créer un compte étudiant
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M8 3l5 5-5 5M3 8h10"/>
                    </svg>
                </a>
                
            </div>

        </div>
    </div>

</body>
</html>