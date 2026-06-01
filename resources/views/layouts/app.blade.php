<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion des Stagiaires') — FST Marrakech</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --fst-blue:     #1a3a6b;
            --fst-blue-light: #2a5298;
            --fst-red:      #c0392b;

            --fst-red-light: #e74c3c;
            --fst-gray:     #f4f6f9;
            --fst-border:   #dee2e6;
        }

        body {
            background-color: var(--fst-gray);

            font-family: 'Segoe UI', sans-serif;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            min-height: 100vh;

            background: linear-gradient(180deg, var(--fst-blue) 0%, var(--fst-blue-light) 100%);
            
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            box-shadow: 4px 0 15px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            padding: 20px 20px 15px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }

        .sidebar-brand h1 {
            color: white;
            font-size: 16px;
            font-weight: 700;
            margin: 0;
            line-height: 1.3;
        }

        .sidebar-brand p {
            color: rgba(255,255,255,0.6);
            font-size: 11px;
            margin: 3px 0 0;
        }

        .sidebar-user {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            background: rgba(0,0,0,0.15);
        }

        .sidebar-user .user-name {
            color: white;
            font-size: 13px;
            font-weight: 600;
        }

        .sidebar-user .user-role {
            color: rgba(255,255,255,0.6);
            font-size: 11px;
        }

        .sidebar-user .user-avatar {
            width: 36px;
            height: 36px;
            background: var(--fst-red);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .sidebar-menu {
            padding: 15px 0;
        }

        .sidebar-menu-title {
            color: rgba(255,255,255,0.4);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 10px 20px 5px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 20px;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-size: 13.5px;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu a:hover {
            color: white;
            background: rgba(255,255,255,0.1);
            border-left-color: rgba(255,255,255,0.4);
        }

        .sidebar-menu a.active {
            color: white;
            background: rgba(255,255,255,0.15);
            border-left-color: var(--fst-red);
            font-weight: 600;
        }

        .sidebar-menu a svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            opacity: 0.8;
        }

        .sidebar-menu a.active svg {
            opacity: 1;
        }

        /* Topbar */
        .topbar {
            margin-left: 260px;
            height: 60px;
            background: white;
            border-bottom: 1px solid var(--fst-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            position: sticky;
            top: 0;
            z-index: 99;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .topbar-title {
            font-size: 17px;
            font-weight: 600;
            color: var(--fst-blue);
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 6px 12px;
            border-radius: 8px;
            transition: background 0.2s;
        }

        .topbar-user:hover {
            background: var(--fst-gray);
        }

        .topbar-user span {
            font-size: 13px;
            font-weight: 500;
            color: #444;
        }

        /* Main content */
        .main-content {
            margin-left: 260px;
            padding: 25px;
            min-height: calc(100vh - 60px);
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 10px;
            border: 1px solid var(--fst-border);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--fst-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h3 {
            font-size: 15px;
            font-weight: 600;
            color: var(--fst-blue);
            margin: 0;
        }

        .card-body {
            padding: 20px;
        }

        /* Stat boxes */
        .stat-box {
            background: white;
            border-radius: 10px;
            padding: 20px;
            border: 1px solid var(--fst-border);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-box-icon {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .stat-box-number {
            font-size: 28px;
            font-weight: 700;
            line-height: 1;
            color: var(--fst-blue);
        }

        .stat-box-label {
            font-size: 12px;
            color: #888;
            margin-top: 3px;
        }

        /* Tables */
        .fst-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
        }

        .fst-table thead th {
            background: var(--fst-gray);
            color: var(--fst-blue);
            font-weight: 600;
            padding: 12px 15px;
            text-align: left;
            border-bottom: 2px solid var(--fst-border);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .fst-table tbody tr {
            border-bottom: 1px solid var(--fst-border);
            transition: background 0.15s;
        }

        .fst-table tbody tr:hover {
            background: #f8f9ff;
        }

        .fst-table tbody td {
            padding: 12px 15px;
            color: #444;
        }

        /* Badges */
        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-success { background: #d4edda; color: #155724; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-danger  { background: #f8d7da; color: #721c24; }
        .badge-info    { background: #d1ecf1; color: #0c5460; }
        .badge-gray    { background: #e9ecef; color: #495057; }

        /* Buttons */
        .btn {
            padding: 8px 16px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--fst-blue);
            color: white;
        }
        .btn-primary:hover { background: var(--fst-blue-light); color: white; }

        .btn-danger {
            background: var(--fst-red);
            color: white;
        }
        .btn-danger:hover { background: var(--fst-red-light); }

        .btn-success {
            background: #27ae60;
            color: white;
        }
        .btn-success:hover { background: #2ecc71; }

        .btn-secondary {
            background: #e9ecef;
            color: #495057;
        }
        .btn-secondary:hover { background: #dee2e6; }

        .btn-sm {
            padding: 5px 12px;
            font-size: 12px;
        }

        .btn-xs {
            padding: 3px 9px;
            font-size: 11px;
        }

        /* Forms */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #444;
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 9px 13px;
            border: 1px solid var(--fst-border);
            border-radius: 7px;
            font-size: 13.5px;
            color: #333;
            background: white;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: var(--fst-blue-light);
            box-shadow: 0 0 0 3px rgba(42,82,152,0.1);
        }

        /* Alerts */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13.5px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        /* Circuit signature */
        .circuit-step {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--fst-border);
        }

        .circuit-step:last-child { border-bottom: none; }

        .circuit-number {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 13px;
            flex-shrink: 0;
        }

        .circuit-number.done { background: #27ae60; color: white; }
        .circuit-number.pending { background: #e9ecef; color: #888; }
        .circuit-number.current { background: var(--fst-red); color: white; }

        /* Progress bar */
        .progress-bar-container {
            background: #e9ecef;
            border-radius: 10px;
            height: 10px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 0.5s ease;
        }

        /* Logout button */
        .sidebar-logout {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 15px 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-logout form button {
            width: 100%;
            padding: 10px;
            background: rgba(192,57,43,0.3);
            border: 1px solid rgba(192,57,43,0.5);
            color: white;
            border-radius: 7px;
            font-size: 13px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s;
        }

        .sidebar-logout form button:hover {
            background: rgba(192,57,43,0.6);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-260px); }
            .topbar { margin-left: 0; }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <aside class="sidebar">

        {{-- Brand --}}
        <div class="sidebar-brand">
            <div style="display:flex; align-items:center; gap:10px;">
                <div style="width:38px; height:38px; background:var(--fst-red);
                            border-radius:8px; display:flex; align-items:center;
                            justify-content:center; font-weight:bold; color:white; font-size:14px;">
                    FST
                </div>
                <div>
                    <h1>Gestion Stagiaires</h1>
                    <p>FST — Marrakech</p>
                </div>
            </div>
        </div>

        {{-- User info --}}
        @auth
        <div class="sidebar-user">
            <div style="display:flex; align-items:center; gap:10px;">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->prenom, 0, 1)) }}
                </div>
                <div>
                    <div class="user-name">
                        {{ auth()->user()->prenom }} {{ auth()->user()->nom }}
                    </div>
                    <div class="user-role">
                       // Dans sidebar-user
@if(auth()->user()->role === 'admin')
    <div class="user-role">Administrateur Système</div>
@elseif(auth()->user()->role === 'doyen')
    <div class="user-role">Doyen</div>
@endif
                    </div>
                </div>
            </div>
        </div>
        @endauth

        {{-- Menu --}}
        <nav class="sidebar-menu">

            @auth
               {{-- Admin --}}
@if(auth()->user()->role === 'admin')
    <div class="sidebar-menu-title">Administration</div>
    <a href="{{ route('admin.dashboard') }}"
       class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        Tableau de bord
    </a>
    <a href="{{ route('admin.utilisateurs') }}"
       class="{{ request()->routeIs('admin.utilisateurs*') ? 'active' : '' }}">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        Utilisateurs
    </a>
    <a href="{{ route('admin.conventions') }}"
       class="{{ request()->routeIs('admin.conventions*') ? 'active' : '' }}">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        Conventions
    </a>
    <a href="{{ route('admin.entreprises') }}"
       class="{{ request()->routeIs('admin.entreprises*') ? 'active' : '' }}">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </svg>
        Entreprises
    </a>

{{-- Doyen (signature uniquement) --}}
@elseif(auth()->user()->role === 'doyen')
    <div class="sidebar-menu-title">Espace Doyen</div>
    <a href="{{ route('doyen.dashboard') }}"
       class="{{ request()->routeIs('doyen.dashboard') ? 'active' : '' }}">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        Conventions à signer
    </a>

                {{-- Chef de filière --}}
                @elseif(auth()->user()->role === 'chef_filiere')
                    <div class="sidebar-menu-title">Chef de Filière</div>
                    <a href="{{ route('chef.dashboard') }}"
                       class="{{ request()->routeIs('chef.dashboard') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Tableau de bord
                    </a>
                    <a href="{{ route('chef.demandes') }}"
                       class="{{ request()->routeIs('chef.demandes*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        Demandes de stage
                    </a>
                    <a href="{{ route('chef.conventions') }}"
                       class="{{ request()->routeIs('chef.conventions*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Conventions
                    </a>

                {{-- Étudiant --}}
                @elseif(auth()->user()->role === 'etudiant')
                    <div class="sidebar-menu-title">Mon espace</div>
                    <a href="{{ route('etudiant.dashboard') }}"
                       class="{{ request()->routeIs('etudiant.dashboard') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Tableau de bord
                    </a>
                    <a href="{{ route('etudiant.demande') }}"
                       class="{{ request()->routeIs('etudiant.demande') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        Demande de stage
                    </a>
                    <a href="{{ route('etudiant.convention') }}"
                       class="{{ request()->routeIs('etudiant.convention*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Ma convention
                    </a>
                    <a href="{{ route('etudiant.gantt') }}"
                       class="{{ request()->routeIs('etudiant.gantt') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Mon Gantt
                    </a>
                    <a href="{{ route('etudiant.rapport') }}"
                       class="{{ request()->routeIs('etudiant.rapport') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Mon rapport
                    </a>

                {{-- Encadrant --}}
                @elseif(auth()->user()->role === 'encadrant')
                    <div class="sidebar-menu-title">Encadrement</div>
                    <a href="{{ route('encadrant.dashboard') }}"
                       class="{{ request()->routeIs('encadrant.dashboard') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Tableau de bord
                    </a>
                    <a href="{{ route('encadrant.etudiants') }}"
                       class="{{ request()->routeIs('encadrant.etudiants*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        </svg>
                        Mes étudiants
                    </a>
                    <a href="{{ route('encadrant.gantt') }}"
                       class="{{ request()->routeIs('encadrant.gantt') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Diagramme Gantt
                    </a>
                @endif
            @endauth

        </nav>

        {{-- Logout --}}
        <div class="sidebar-logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Déconnexion
                </button>
            </form>
        </div>

    </aside>

    {{-- Topbar --}}
    <header class="topbar">
        <div class="topbar-title">@yield('page_title', 'Tableau de bord')</div>
        <div class="topbar-actions">
            @auth
            <div class="topbar-user">
                <div style="width:32px; height:32px; background:var(--fst-blue);
                            border-radius:50%; display:flex; align-items:center;
                            justify-content:center; color:white; font-size:12px; font-weight:bold;">
                    {{ strtoupper(substr(auth()->user()->prenom, 0, 1)) }}
                </div>
                <span>{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</span>
            </div>
            @endauth
        </div>
    </header>

    {{-- Main content --}}
    <main class="main-content">

        {{-- Alerts --}}
        @if(session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                 {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </main>

</body>
</html>