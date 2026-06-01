@extends('layouts.app')

@section('page_title', 'Tableau de bord — Chef de Filière')

@section('content')

<div style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:24px;">
    <div class="stat-box">
        <div class="stat-box-icon" style="background:#e8f0fe;">🎓</div>
        <div>
            <div class="stat-box-number">{{ $stats['etudiants'] }}</div>
            <div class="stat-box-label">Étudiants de ma filière</div>
        </div>
    </div>
    <div class="stat-box">
        <div class="stat-box-icon" style="background:#e8f5e9;">📄</div>
        <div>
            <div class="stat-box-number">{{ $stats['conventions'] }}</div>
            <div class="stat-box-label">Conventions</div>
        </div>
    </div>   \\c
    <div class="stat-box">
        <div class="stat-box-icon" style="background:#fce4ec;">✍️</div>
        <div>
            <div class="stat-box-number">{{ $stats['a_signer'] }}</div>
            <div class="stat-box-label">À signer</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Actions rapides</h3>
    </div>
    <div class="card-body" style="display:flex; gap:10px; flex-wrap:wrap;">
        <a href="{{ route('chef.demandes') }}" class="btn btn-primary">
            📄 Demandes de stage
        </a>
        <a href="{{ route('chef.conventions') }}" class="btn btn-success">
            📋 Conventions
        </a>
    </div>
</div>

@endsection