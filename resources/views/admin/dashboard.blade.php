@extends('layouts.app')

@section('page_title', 'Tableau de bord — Administration')

@section('content')

<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px;">
    <div class="stat-box">
        <div class="stat-box-icon" style="background:#e8f0fe;">🎓</div>
        <div>
            <div class="stat-box-number">{{ $stats['etudiants'] }}</div>
            <div class="stat-box-label">Étudiants</div>
        </div>
    </div>
    <div class="stat-box">
        <div class="stat-box-icon" style="background:#e8f5e9;">👨‍🏫</div>
        <div>
            <div class="stat-box-number">{{ $stats['encadrants'] }}</div>
            <div class="stat-box-label">Encadrants</div>
        </div>
    </div>  \\c
    <div class="stat-box">
        <div class="stat-box-icon" style="background:#fff3e0;">👔</div>
        <div>
            <div class="stat-box-number">{{ $stats['chefs'] }}</div>
            <div class="stat-box-label">Chefs de filière</div>
        </div>
    </div>
    <div class="stat-box">
        <div class="stat-box-icon" style="background:#fce4ec;">🏛️</div>
        <div>
            <div class="stat-box-number">{{ $stats['doyens'] }}</div>
            <div class="stat-box-label">Doyens</div>
        </div>
    </div>
    <div class="stat-box">
        <div class="stat-box-icon" style="background:#f3e8fd;">🏢</div>
        <div>
            <div class="stat-box-number">{{ $stats['entreprises'] }}</div>
            <div class="stat-box-label">Entreprises</div>
        </div>
    </div>
    <div class="stat-box">
        <div class="stat-box-icon" style="background:#e8eaf6;">📄</div>
        <div>
            <div class="stat-box-number">{{ $stats['conventions'] }}</div>
            <div class="stat-box-label">Conventions</div>
        </div>
    </div>
    <div class="stat-box">
        <div class="stat-box-icon" style="background:#e0f2f1;">✅</div>
        <div>
            <div class="stat-box-number">{{ $stats['signees'] }}</div>
            <div class="stat-box-label">Conventions signées</div>
        </div>
    </div>
    <div class="stat-box">
        <div class="stat-box-icon" style="background:#fff8e1;">⏳</div>
        <div>
            <div class="stat-box-number" style="color:#e67e22;">{{ $stats['a_traiter'] }}</div>
            <div class="stat-box-label">À traiter</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><h3>Actions rapides</h3></div>
    <div class="card-body" style="display:flex; gap:10px; flex-wrap:wrap;">
        <a href="{{ route('admin.utilisateurs') }}" class="btn btn-primary">
            👥 Gérer les utilisateurs
        </a>
        <a href="{{ route('admin.conventions') }}" class="btn btn-success">
            📄 Conventions à traiter
        </a>
        <a href="{{ route('admin.entreprises') }}" class="btn btn-secondary">
            🏢 Entreprises
        </a>
    </div>
</div>

@endsection