@extends('layouts.app')

@section('page_title', 'Tableau de bord — Doyen')

@section('content')

<div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:16px; margin-bottom:24px;">

    <div class="stat-box">
        <div class="stat-box-icon" style="background:#e8f0fe;">🎓</div>
        <div>
            <div class="stat-box-number">{{ $stats['etudiants'] }}</div>
            <div class="stat-box-label">Étudiants</div>
        </div>
    </div>
\\c
    <div class="stat-box">
        <div class="stat-box-icon" style="background:#e8f5e9;">👨‍🏫</div>
        <div>
            <div class="stat-box-number">{{ $stats['encadrants'] }}</div>
            <div class="stat-box-label">Encadrants</div>
        </div>
    </div>

    <div class="stat-box">
        <div class="stat-box-icon" style="background:#fff3e0;">👔</div>
        <div>
            <div class="stat-box-number">{{ $stats['chefs'] }}</div>
            <div class="stat-box-label">Chefs de filière</div>
        </div>
    </div>

    <div class="stat-box">
        <div class="stat-box-icon" style="background:#fce4ec;">🏢</div>
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

</div>

<div class="card">
    <div class="card-header">
        <h3>Actions rapides</h3>
    </div>
    <div class="card-body" style="display:flex; gap:10px; flex-wrap:wrap;">
        
        <a href="{{ route('doyen.conventions') }}" class="btn btn-success">
            📄 Voir les conventions
        </a>
    </div>
</div>

@endsection