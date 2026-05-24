<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Stagiaires — FST Marrakech</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy:   #0f1f3d;
            --navy2:  #1a3460;
            --red:    #c0392b;
            --red2:   #e74c3c;
            --gold:   #e8a020;
            --gold2:  #f0b429;
            --light:  #f7f8fc;
            --white:  #ffffff;
            --border: #e4e8f0;
            --text:   #1a2233;
            --muted:  #6b7a99;
            --purple: #6c3fc5;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--white);
            color: var(--text);
            line-height: 1.6;
        }

        h1,h2,h3,h4 { font-family: 'Sora', sans-serif; }

        /* ═══════════════════════════════
           TOPBAR
        ═══════════════════════════════ */
        .topbar {
            background: var(--navy);
            height: 100px;
            display: flex;
            align-items: stretch;
            justify-content: space-between;
            padding: 0 48px;
            border-bottom: 3px solid var(--gold);
        }

        .topbar img {
            height: 100%;
            width: auto;
            object-fit: fill;
            display: block;
        }

        .topbar-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-end;
            gap: 4px;
        }

        .topbar-info .uni {
            font-family: 'Sora', sans-serif;
            font-size: 14px;
            font-weight: 700;
            color: #fff;
        }

        .topbar-info .addr {
            font-size: 12px;
            color: rgba(255,255,255,0.55);
        }

        /* ═══════════════════════════════
           MAIN NAV
        ═══════════════════════════════ */
        .mainnav {
            background: #1c1c1c;
            height: 50px;
            display: flex;
            align-items: stretch;
            padding: 0 48px;
            position: sticky;
            top: 0;
            z-index: 300;
        }

        .mainnav-links {
            display: flex;
            align-items: stretch;
            gap: 0;
        }

        .mainnav-links a {
            display: flex;
            align-items: center;
            padding: 0 18px;
            font-size: 13.5px;
            font-weight: 500;
            color: rgba(255,255,255,0.82);
            text-decoration: none;
            border-right: 1px solid rgba(255,255,255,0.07);
            transition: background 0.18s, color 0.18s;
            white-space: nowrap;
        }

        .mainnav-links a:first-child {
            background: var(--purple);
            color: white;
            font-weight: 600;
            border-right: none;
        }

        .mainnav-links a:hover {
            background: rgba(255,255,255,0.08);
            color: white;
        }

        .mainnav-links a svg {
            width: 12px; height: 12px;
            margin-left: 5px;
            opacity: 0.6;
        }

        /* ═══════════════════════════════
           HERO — 2 COLS (banner + accès)
        ═══════════════════════════════ */
        .hero-wrap {
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 0;
            background: var(--light);
            border-bottom: 1px solid var(--border);
        }

        /* Left: blue banner */
        .hero-banner {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 60%, #1a4a7a 100%);
            position: relative;
            overflow: hidden;
            padding: 60px 52px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 400px;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 48px 48px;
        }

        .hero-banner::after {
            content: '';
            position: absolute;
            bottom: -80px; right: -80px;
            width: 340px; height: 340px;
            border-radius: 50%;
            background: rgba(232,160,32,0.07);
        }

        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(232,160,32,0.15);
            border: 1px solid rgba(232,160,32,0.35);
            padding: 5px 14px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 600;
            color: var(--gold2);
            margin-bottom: 24px;
            width: fit-content;
            position: relative;
            z-index: 2;
        }

        .hero-pill-dot {
            width: 6px; height: 6px;
            background: var(--gold2);
            border-radius: 50%;
            animation: blink 2s infinite;
        }

        @keyframes blink {
            0%,100% { opacity:1; }
            50% { opacity:0.3; }
        }

        .hero-banner h1 {
            font-size: 42px;
            font-weight: 800;
            line-height: 1.15;
            color: white;
            letter-spacing: -1px;
            margin-bottom: 16px;
            position: relative;
            z-index: 2;
        }

        .hero-banner h1 span {
            color: var(--gold2);
            display: block;
        }

        .hero-banner p {
            font-size: 15.5px;
            color: rgba(255,255,255,0.55);
            line-height: 1.75;
            max-width: 480px;
            margin-bottom: 36px;
            position: relative;
            z-index: 2;
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            position: relative;
            z-index: 2;
        }

        .btn-white {
            padding: 12px 24px;
            background: white;
            color: var(--navy);
            border-radius: 8px;
            font-family: 'Sora', sans-serif;
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-white:hover {
            background: var(--gold2);
            color: var(--navy);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }

        .btn-ghost-white {
            padding: 12px 24px;
            background: transparent;
            color: rgba(255,255,255,0.8);
            border: 1.5px solid rgba(255,255,255,0.25);
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13.5px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-ghost-white:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.5);
            color: white;
        }

        /* Stat bar inside hero */
        .hero-stats {
            display: flex;
            gap: 32px;
            margin-top: 40px;
            padding-top: 32px;
            border-top: 1px solid rgba(255,255,255,0.1);
            position: relative;
            z-index: 2;
        }

        .hstat {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .hstat-num {
            font-family: 'Sora', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: white;
            line-height: 1;
        }

        .hstat-num.gold { color: var(--gold2); }

        .hstat-lbl {
            font-size: 11px;
            color: rgba(255,255,255,0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Right: Accès rapide panel */
        .hero-access {
            background: white;
            border-left: 1px solid var(--border);
            padding: 36px 28px;
            display: flex;
            flex-direction: column;
        }

        .access-title {
            font-family: 'Sora', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 26px;
            padding-bottom: 16px;
            border-bottom: 2px solid var(--border);
        }

        .access-title span {
            color: var(--purple);
        }

        .access-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 22px;
            border-radius: 10px;
            font-family: 'Sora', sans-serif;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
        }

        .access-btn::before {
            content: '';
            position: absolute;
            top: 0; left: 0; bottom: 0;
            width: 4px;
        }

        .access-btn svg {
            width: 18px; height: 18px;
            flex-shrink: 0;
            opacity: 0.7;
        }

        .access-btn:hover {
            transform: translateX(3px);
        }

        .ab-blue {
            background: #eef2fb;
            color: var(--navy);
        }
        .ab-blue::before { background: var(--navy); }
        .ab-blue:hover { background: #dde6f8; color: var(--navy); }

        .ab-gold {
            background: #fdf4e3;
            color: #7a4a00;
        }
        .ab-gold::before { background: var(--gold); }
        .ab-gold:hover { background: #fae8c4; }

        .ab-dark {
            background: #1c1c1c;
            color: white;
        }
        .ab-dark::before { background: #555; }
        .ab-dark:hover { background: #2d2d2d; color: white; }

        .ab-red {
            background: var(--red);
            color: white;
        }
        .ab-red::before { background: #8b1a10; }
        .ab-red:hover { background: var(--red2); color: white; }

        .access-divider {
            height: 1px;
            background: var(--border);
            margin: 14px 0;
        }

        /* connexion dropdown inside panel */
        .panel-dropdown { position: relative; }

        .panel-drop-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 14px 18px;
            border-radius: 10px;
            font-family: 'Sora', sans-serif;
            font-size: 13.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: var(--navy);
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
            margin-bottom: 10px;
            text-decoration: none;
        }

        .panel-drop-btn svg {
            width: 16px; height: 16px;
            transition: transform 0.2s;
        }

        .panel-dropdown:hover .panel-drop-btn { background: var(--navy2); }
        .panel-dropdown:hover .panel-drop-btn svg { transform: rotate(180deg); }

        .panel-drop-menu {
            display: none;
            position: absolute;
            left: 0; right: 0;
            top: calc(100% - 6px);
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 12px 32px rgba(15,31,61,0.14);
            z-index: 400;
            overflow: hidden;
            padding: 4px;
        }

        .panel-dropdown:hover .panel-drop-menu { display: block; }

        .pdrop-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
            text-decoration: none;
            transition: background 0.15s;
            font-family: 'DM Sans', sans-serif;
        }

        .pdrop-item:hover { background: var(--light); color: var(--navy); }

        .pdrop-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* ═══════════════════════════════
           RIBBON
        ═══════════════════════════════ */
        .ribbon {
            background: var(--red);
            padding: 16px 48px;
            display: flex;
            justify-content: center;
            gap: 64px;
        }

        .rib-item { text-align: center; }

        .rib-num {
            font-family: 'Sora', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: white;
            line-height: 1;
        }

        .rib-lbl {
            font-size: 11px;
            color: rgba(255,255,255,0.65);
            margin-top: 3px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ═══════════════════════════════
           WORKFLOW SECTION
        ═══════════════════════════════ */
        .workflow {
            padding: 72px 48px;
            background: var(--light);
        }

        .sec-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--red);
            margin-bottom: 10px;
        }

        .sec-tag::before {
            content: '';
            display: block;
            width: 18px; height: 2px;
            background: var(--red);
            border-radius: 2px;
        }

        .sec-title {
            font-size: 32px;
            font-weight: 800;
            color: var(--navy);
            letter-spacing: -0.8px;
            margin-bottom: 6px;
        }

        .sec-sub {
            font-size: 14.5px;
            color: var(--muted);
            margin-bottom: 52px;
        }

        .flow-track {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            max-width: 860px;
            margin: 0 auto;
            position: relative;
        }

        .flow-track::before {
            content: '';
            position: absolute;
            top: 28px;
            left: 80px; right: 80px;
            height: 2px;
            background: var(--border);
            z-index: 0;
        }

        .flow-step {
            flex: 1;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .flow-circle {
            width: 56px; height: 56px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Sora', sans-serif;
            font-size: 18px;
            font-weight: 800;
            margin: 0 auto 14px;
            border: 3px solid white;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        }

        .flow-step:nth-child(1) .flow-circle { background: var(--navy); color: white; }
        .flow-step:nth-child(2) .flow-circle { background: var(--red); color: white; }
        .flow-step:nth-child(3) .flow-circle { background: var(--purple); color: white; }
        .flow-step:nth-child(4) .flow-circle {
            background: #1a8a55; color: white;
            box-shadow: 0 0 0 6px rgba(26,138,85,0.12);
        }

        .flow-arrow {
            flex: 0;
            font-size: 20px;
            color: var(--border);
            padding: 0 4px;
            padding-bottom: 40px;
            align-self: flex-start;
            margin-top: 16px;
        }

        .flow-name {
            font-family: 'Sora', sans-serif;
            font-size: 14px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 4px;
        }

        .flow-desc {
            font-size: 12px;
            color: var(--muted);
        }

        .flow-ok {
            display: inline-block;
            margin-top: 8px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 100px;
            background: #e8f5ee;
            color: #1a8a55;
        }

        /* ═══════════════════════════════
           FEATURES DARK STRIP
        ═══════════════════════════════ */
        .features {
            background: var(--navy);
            padding: 56px 48px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 32px;
        }

        .feat {
            border-left: 2px solid rgba(255,255,255,0.1);
            padding-left: 20px;
        }

        .feat-num {
            font-family: 'Sora', sans-serif;
            font-size: 32px;
            font-weight: 800;
            color: var(--gold2);
            line-height: 1;
            margin-bottom: 6px;
        }

        .feat-title {
            font-family: 'Sora', sans-serif;
            font-size: 14.5px;
            font-weight: 700;
            color: white;
            margin-bottom: 6px;
        }

        .feat-desc {
            font-size: 12.5px;
            color: rgba(255,255,255,0.45);
            line-height: 1.6;
        }

        /* ═══════════════════════════════
           FOOTER
        ═══════════════════════════════ */
        .footer {
            background: #080f1e;
            padding: 48px 48px 20px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 48px;
            padding-bottom: 36px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        .footer-logo-name {
            font-family: 'Sora', sans-serif;
            font-size: 17px;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
        }

        .footer-logo-sub {
            font-size: 13px;
            color: rgba(255,255,255,0.38);
            line-height: 1.7;
            max-width: 270px;
        }

        .footer-contact {
            margin-top: 18px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .footer-contact span {
            font-size: 12px;
            color: rgba(255,255,255,0.4);
        }

        .footer-col h4 {
            font-family: 'Sora', sans-serif;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            color: rgba(255,255,255,0.25);
            margin-bottom: 16px;
        }

        .footer-col a {
            display: block;
            font-size: 13px;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            margin-bottom: 10px;
            transition: color 0.18s;
        }

        .footer-col a:hover { color: white; }

        .footer-bottom {
            padding-top: 20px;
            font-size: 11.5px;
            color: rgba(255,255,255,0.2);
            text-align: center;
        }
    </style>
</head>
<body>

    {{-- ═══ TOPBAR ═══ --}}
    <div class="topbar">
        <img src="{{ asset('images/logo-fst.png') }}"
             alt="FST Marrakech"
             onerror="this.style.display='none'">
        <div class="topbar-info">
            <span class="uni">Université Cadi Ayyad — Marrakech</span>
            <span class="addr">Avenue Abdelkrim Khattabi BP 549 Marrakech Maroc</span>
            <span class="addr">Tél : +212 524 43 34 04 &nbsp;|&nbsp; Fax : +212 524 43 31 70</span>
        </div>
    </div>

    {{-- ═══ MAIN NAV ═══ --}}
    <nav class="mainnav">
        <div class="mainnav-links">
            <a href="/">Accueil</a>
            <a href="{{ route('login') }}">Se connecter</a>
            <a href="{{ route('register') }}">Créer un compte</a>
            <a href="{{ route('entreprise.login') }}">Espace Entreprise</a>
        </div>
    </nav>

    {{-- ═══ HERO + ACCÈS RAPIDE ═══ --}}
    <div class="hero-wrap">

        {{-- Left: Banner --}}
        <div class="hero-banner">
            <div class="hero-pill">
                <span class="hero-pill-dot"></span>
                Plateforme officielle FST Marrakech
            </div>

            <h1>
                Gestion des Stages
                <span>100% Numérique</span>
            </h1>

            <p>
                Conventions de stage, signatures numériques et suivi pédagogique
                centralisés en une seule plateforme. Zéro papier, zéro délai.
            </p>

            <div class="hero-actions">
                <a href="{{ route('register') }}" class="btn-white">
                    Créer un compte
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M8 3l5 5-5 5M3 8h10"/>
                    </svg>
                </a>
                <a href="{{ route('login') }}" class="btn-ghost-white">
                    Se connecter
                </a>
            </div>

            <div class="hero-stats">
                <div class="hstat">
                    <span class="hstat-num gold">2</span>
                    <span class="hstat-lbl">Types de convention</span>
                </div>
                <div class="hstat">
                    <span class="hstat-num">4</span>
                    <span class="hstat-lbl">Signatures requises</span>
                </div>
                <div class="hstat">
                    <span class="hstat-num">5</span>
                    <span class="hstat-lbl">Espaces dédiés</span>
                </div>
                <div class="hstat">
                    <span class="hstat-num gold">0</span>
                    <span class="hstat-lbl">Papier nécessaire</span>
                </div>
            </div>
        </div>

        {{-- Right: Accès rapide (style site FST) --}}
        <div class="hero-access">
            <div class="access-title">
                Accès <span>rapide</span>
            </div>

            <a href="{{ route('login') }}" class="access-btn ab-blue">
                Espace Étudiant
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M8 3l5 5-5 5M3 8h10"/>
                </svg>
            </a>

            <a href="{{ route('login') }}" class="access-btn ab-gold">
                Espace Encadrant
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M8 3l5 5-5 5M3 8h10"/>
                </svg>
            </a>

            <a href="{{ route('login') }}" class="access-btn ab-dark">
                Espace Chef Filière
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M8 3l5 5-5 5M3 8h10"/>
                </svg>
            </a>

            <a href="{{ route('login') }}" class="access-btn ab-dark" style="background:#2a2a6e;">
                Espace Doyen
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M8 3l5 5-5 5M3 8h10"/>
                </svg>
            </a>

            <a href="{{ route('entreprise.login') }}" class="access-btn ab-red">
                Espace Entreprise
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M8 3l5 5-5 5M3 8h10"/>
                </svg>
            </a>

            <div class="access-divider"></div>

            <a href="{{ route('register') }}" class="access-btn" style="background:#e8f5ee;color:#1a6b40;position:relative;overflow:hidden;">
                <span style="position:absolute;top:0;left:0;bottom:0;width:4px;background:#1a8a55;"></span>
                Créer un compte
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M8 3l5 5-5 5M3 8h10"/>
                </svg>
            </a>
        </div>

    </div>

    {{-- ═══ RIBBON ═══ --}}
    <div class="ribbon">
        <div class="rib-item">
            <div class="rib-num">100%</div>
            <div class="rib-lbl">Numérique</div>
        </div>
        <div class="rib-item">
            <div class="rib-num">4</div>
            <div class="rib-lbl">Étapes de signature</div>
        </div>
        <div class="rib-item">
            <div class="rib-num">5</div>
            <div class="rib-lbl">Rôles utilisateurs</div>
        </div>
        <div class="rib-item">
            <div class="rib-num">2</div>
            <div class="rib-lbl">Types de convention</div>
        </div>
    </div>

    {{-- ═══ CIRCUIT DE SIGNATURE ═══ --}}
    <section class="workflow">
        <div class="sec-tag">Circuit numérique</div>
        <h2 class="sec-title">Circuit de signature</h2>
        <p class="sec-sub">Un flux de validation séquentiel entièrement dématérialisé — zéro papier</p>

        <div class="flow-track">
            <div class="flow-step">
                <div class="flow-circle">1</div>
                <div class="flow-name">Doyen</div>
                <div class="flow-desc">Validation initiale</div>
            </div>
            <div class="flow-arrow">→</div>
            <div class="flow-step">
                <div class="flow-circle">2</div>
                <div class="flow-name">Chef de Filière</div>
                <div class="flow-desc">Affectation & visa</div>
            </div>
            <div class="flow-arrow">→</div>
            <div class="flow-step">
                <div class="flow-circle">3</div>
                <div class="flow-name">Étudiant</div>
                <div class="flow-desc">Signature personnelle</div>
            </div>
            <div class="flow-arrow">→</div>
            <div class="flow-step">
                <div class="flow-circle">4</div>
                <div class="flow-name">Entreprise</div>
                <div class="flow-desc">Signature finale</div>
                <span class="flow-ok">Validé</span>
            </div>
        </div>
    </section>

    {{-- ═══ FEATURES STRIP ═══ --}}
    <div class="features">
        <div class="feat">
            <div class="feat-num">2</div>
            <div class="feat-title">Types de convention</div>
            <div class="feat-desc">Génération automatique selon le type de stage sélectionné.</div>
        </div>
        <div class="feat">
            <div class="feat-num">4</div>
            <div class="feat-title">Signatures numériques</div>
            <div class="feat-desc">Circuit séquentiel traçable et archivé sans papier.</div>
        </div>
        <div class="feat">
            <div class="feat-num">5</div>
            <div class="feat-title">Espaces dédiés</div>
            <div class="feat-desc">Chaque rôle dispose de son propre portail sécurisé.</div>
        </div>
        <div class="feat">
            <div class="feat-num">0</div>
            <div class="feat-title">Papier nécessaire</div>
            <div class="feat-desc">Processus entièrement dématérialisé de A à Z.</div>
        </div>
    </div>

    {{-- ═══ FOOTER ═══ --}}
    <footer class="footer">
        <div class="footer-grid">
            <div>
                <div class="footer-logo-name">Faculté des Sciences et Techniques</div>
                <div class="footer-logo-sub">
                    Plateforme de gestion des stages — Université Cadi Ayyad, Marrakech.
                    Dématérialisation complète du processus de convention de stage.
                </div>
                <div class="footer-contact">
                    <span>Avenue Abdelkrim Khattabi BP 549, Marrakech</span>
                    <span>Tél : +212 524 43 34 04 — Fax : +212 524 43 31 70</span>
                </div>
            </div>
            <div class="footer-col">
                <h4>Espaces</h4>
                <a href="{{ route('login') }}">Espace Étudiant</a>
                <a href="{{ route('entreprise.login') }}">Espace Entreprise</a>
                <a href="{{ route('login') }}">Espace Doyen</a>
                <a href="{{ route('login') }}">Chef de Filière</a>
                <a href="{{ route('login') }}">Encadrant</a>
            </div>
            <div class="footer-col">
                <h4>Accès rapide</h4>
                <a href="{{ route('login') }}">Se connecter</a>
                <a href="{{ route('register') }}">Créer un compte</a>
                <a href="{{ route('entreprise.login') }}">Espace Entreprise</a>
            </div>
        </div>
        <div class="footer-bottom">
            © {{ date('Y') }} Plateforme de Gestion des Stagiaires — Faculté des Sciences et Techniques — Université Cadi Ayyad, Marrakech
        </div>
    </footer>

</body>
</html>