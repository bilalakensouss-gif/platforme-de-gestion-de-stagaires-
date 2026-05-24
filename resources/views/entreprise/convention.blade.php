<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conventions — Espace Entreprise</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --fst-blue:#1a3a6b; --fst-blue-light:#2a5298; --fst-red:#c0392b; --fst-green:#27ae60; }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Segoe UI', sans-serif; background:#f4f6f9; }
        .sidebar { width:240px; min-height:100vh; background:linear-gradient(180deg,#27ae60 0%,#1e8449 100%); position:fixed; top:0; left:0; box-shadow:4px 0 15px rgba(0,0,0,0.15); }
        .sidebar-brand { padding:20px; border-bottom:1px solid rgba(255,255,255,0.15); }
        .sidebar-brand h1 { color:white; font-size:14px; font-weight:700; }
        .sidebar-brand p { color:rgba(255,255,255,0.6); font-size:11px; }
        .sidebar-user { padding:15px 20px; border-bottom:1px solid rgba(255,255,255,0.1); background:rgba(0,0,0,0.1); }
        .sidebar-user .name { color:white; font-size:13px; font-weight:600; }
        .sidebar-user .role { color:rgba(255,255,255,0.6); font-size:11px; }
        .sidebar-menu { padding:15px 0; }
        .sidebar-menu a { display:flex; align-items:center; gap:10px; padding:11px 20px; color:rgba(255,255,255,0.75); text-decoration:none; font-size:13.5px; border-left:3px solid transparent; transition:all 0.2s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { color:white; background:rgba(255,255,255,0.15); border-left-color:white; }
        .sidebar-logout { position:absolute; bottom:0; left:0; right:0; padding:15px 20px; border-top:1px solid rgba(255,255,255,0.1); }
        .sidebar-logout form button { width:100%; padding:9px; background:rgba(0,0,0,0.2); border:1px solid rgba(255,255,255,0.2); color:white; border-radius:7px; font-size:13px; cursor:pointer; }
        .topbar { margin-left:240px; height:60px; background:white; border-bottom:1px solid #dee2e6; display:flex; align-items:center; justify-content:space-between; padding:0 25px; position:sticky; top:0; z-index:99; box-shadow:0 2px 8px rgba(0,0,0,0.06); }
        .topbar-title { font-size:17px; font-weight:600; color:var(--fst-blue); }
        .main-content { margin-left:240px; padding:25px; }
        .card { background:white; border-radius:10px; border:1px solid #dee2e6; box-shadow:0 2px 8px rgba(0,0,0,0.05); margin-bottom:20px; }
        .card-header { padding:16px 20px; border-bottom:1px solid #dee2e6; display:flex; justify-content:space-between; align-items:center; }
        .card-header h3 { font-size:15px; font-weight:600; color:var(--fst-blue); margin:0; }
        .card-body { padding:20px; }
        .fst-table { width:100%; border-collapse:collapse; font-size:13.5px; }
        .fst-table thead th { background:#f4f6f9; color:var(--fst-blue); font-weight:600; padding:12px 15px; text-align:left; border-bottom:2px solid #dee2e6; font-size:12px; text-transform:uppercase; }
        .fst-table tbody tr { border-bottom:1px solid #dee2e6; transition:background 0.15s; }
        .fst-table tbody tr:hover { background:#f8f9ff; }
        .fst-table tbody td { padding:12px 15px; color:#444; }
        .badge { padding:4px 10px; border-radius:20px; font-size:11px; font-weight:600; }
        .badge-success { background:#d4edda; color:#155724; }
        .badge-warning { background:#fff3cd; color:#856404; }
        .badge-danger { background:#f8d7da; color:#721c24; }
        .btn { padding:7px 14px; border-radius:7px; font-size:12px; font-weight:500; cursor:pointer; border:none; transition:all 0.2s; display:inline-flex; align-items:center; gap:5px; text-decoration:none; }
        .btn-primary { background:var(--fst-blue); color:white; }
        .btn-success { background:var(--fst-green); color:white; }
        .btn-secondary { background:#e9ecef; color:#495057; }
        .btn-xs { padding:3px 9px; font-size:11px; }
        .alert { padding:12px 16px; border-radius:8px; font-size:13.5px; margin-bottom:16px; }
        .alert-success { background:#d4edda; color:#155724; border:1px solid #c3e6cb; }
        .alert-danger { background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; }
        .circuit-dot { width:12px; height:12px; border-radius:50%; display:inline-block; margin-right:4px; }
        .dot-done { background:#27ae60; }
        .dot-pending { background:#dee2e6; }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <aside class="sidebar">
        <div class="sidebar-brand">
            <h1>🏢 Espace Entreprise</h1>
            <p>FST Marrakech</p>
        </div>
        <div class="sidebar-user">
            <div class="name">{{ Auth::guard('entreprise')->user()->raison_sociale }}</div>
            <div class="role">{{ Auth::guard('entreprise')->user()->secteur }}</div>
        </div>
        <nav class="sidebar-menu">
            <a href="{{ route('entreprise.dashboard') }}"
               class="{{ request()->routeIs('entreprise.dashboard') ? 'active' : '' }}">
                🏠 Tableau de bord
            </a>
            <a href="{{ route('entreprise.convention') }}"
               class="{{ request()->routeIs('entreprise.convention*') ? 'active' : '' }}">
                📄 Conventions
            </a>
        </nav>
        <div class="sidebar-logout">
            <form method="POST" action="{{ route('entreprise.logout') }}">
                @csrf
                <button type="submit">🚪 Déconnexion</button>
            </form>
        </div>
    </aside>

    {{-- Topbar --}}
    <header class="topbar">
        <div class="topbar-title">Conventions — Signature Entreprise (Étape 4)</div>
    </header>

    {{-- Content --}}
    <main class="main-content">

        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">❌ {{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>Conventions de stage</h3>
            </div>
            <div class="card-body" style="padding:0;">
                <table class="fst-table">
                    <thead>
                        <tr>
                            <th>Étudiant</th>
                            <th>Type</th>
                            <th>Période</th>
                            <th>État</th>
                            <th>Circuit</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($conventions as $conv)
                        <tr>
                            <td>
                                {{ $conv->etudiant->prenom }} {{ $conv->etudiant->nom }}<br>
                                <span style="color:#888; font-size:11px;">
                                    {{ $conv->etudiant->filiere }}
                                </span>
                            </td>
                            <td>{{ $conv->type === 'stage_classique' ? 'Stage classique' : 'PFE' }}</td>
                            <td style="font-size:12px;">
                                {{ $conv->date_debut->format('d/m/Y') }}<br>
                                {{ $conv->date_fin->format('d/m/Y') }}
                            </td>
                            <td>
                                @if($conv->etat === 'signee')
                                    <span class="badge badge-success">Signée ✓</span>
                                @elseif($conv->etat === 'partiellement_signee')
                                    <span class="badge badge-warning">En cours</span>
                                @else
                                    <span class="badge badge-danger">Non signée</span>
                                @endif
                            </td>
                            <td>
                                <div style="display:flex; gap:3px; align-items:center;">
                                    <span class="circuit-dot {{ $conv->date_signature_doyen ? 'dot-done' : 'dot-pending' }}"
                                          title="Doyen"></span>
                                    <span class="circuit-dot {{ $conv->date_signature_chef ? 'dot-done' : 'dot-pending' }}"
                                          title="Chef"></span>
                                    <span class="circuit-dot {{ $conv->date_signature_etudiant ? 'dot-done' : 'dot-pending' }}"
                                          title="Étudiant"></span>
                                    <span class="circuit-dot {{ $conv->date_signature_entreprise ? 'dot-done' : 'dot-pending' }}"
                                          title="Entreprise"></span>
                                </div>
                                <span style="font-size:10px; color:#888;">D C E En</span>
                            </td>
                            <td>
                                <div style="display:flex; flex-direction:column; gap:5px;">
                                    <a href="{{ route('entreprise.convention.pdf', $conv->id) }}"
                                       class="btn btn-secondary btn-xs">📄 PDF</a>
                                    @if(!$conv->date_signature_entreprise && $conv->date_signature_etudiant)
                                        <form method="POST"
                                              action="{{ route('entreprise.convention.signer', $conv->id) }}">
                                            @csrf
                                            <button class="btn btn-success btn-xs">✍️ Signer</button>
                                        </form>
                                    @elseif($conv->date_signature_entreprise)
                                        <span style="color:#27ae60; font-size:11px;">✓ Signé</span>
                                    @else
                                        <span style="color:#999; font-size:11px;">Attente étudiant</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:#999;padding:30px;">
                                Aucune convention associée.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</body>
</html>