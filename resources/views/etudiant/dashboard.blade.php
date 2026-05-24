@extends('layouts.app')

@section('page_title', 'Tableau de bord — Étudiant')

@section('content')

<div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:24px;">

    {{-- Profil --}}
    <div class="card">
        <div class="card-header"><h3>Mon profil</h3></div>
        <div class="card-body">
            <p style="margin-bottom:8px;">
                <span style="color:#888; font-size:12px;">Nom</span><br>
                <strong>{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</strong>
            </p>
            <p style="margin-bottom:8px;">
                <span style="color:#888; font-size:12px;">Filière</span><br>
                <strong>{{ auth()->user()->filiere }}</strong>
            </p>
            <p>
                <span style="color:#888; font-size:12px;">Email</span><br>
                <strong>{{ auth()->user()->email }}</strong>
            </p>
        </div>
    </div>

    {{-- Convention --}}
    <div class="card">
        <div class="card-header"><h3>Ma convention</h3></div>
        <div class="card-body">
            @if($convention)
                <p style="margin-bottom:8px;">
                    <span style="color:#888; font-size:12px;">Type</span><br>
                    <strong>{{ $convention->type === 'stage_classique' ? 'Stage classique' : 'PFE' }}</strong>
                </p>
                <p style="margin-bottom:8px;">
                    <span style="color:#888; font-size:12px;">Entreprise</span><br>
                    <strong>{{ $convention->entreprise->raison_sociale }}</strong>
                </p>
                <p style="margin-bottom:12px;">
                    <span style="color:#888; font-size:12px;">État</span><br>
                    @if($convention->etat === 'signee')
                        <span class="badge badge-success">Signée ✓</span>
                    @elseif($convention->etat === 'partiellement_signee')
                        <span class="badge badge-warning">En cours</span>
                    @else
                        <span class="badge badge-danger">Non signée</span>
                    @endif
                </p>
                <a href="{{ route('etudiant.convention') }}" class="btn btn-primary btn-sm">
                    Voir ma convention
                </a>
            @else
                <p style="color:#999; margin-bottom:12px;">Aucune convention créée.</p>
                <a href="{{ route('etudiant.convention.create') }}" class="btn btn-success btn-sm">
                    + Créer une convention
                </a>
            @endif
        </div>
    </div>

</div>

{{-- Actions rapides --}}
<div class="card">
    <div class="card-header"><h3>Actions rapides</h3></div>
    <div class="card-body" style="display:flex; gap:10px; flex-wrap:wrap;">
        <a href="{{ route('etudiant.demande') }}" class="btn btn-primary">
            📄 Demande de stage
        </a>
        <a href="{{ route('etudiant.convention') }}" class="btn btn-secondary">
            📋 Ma convention
        </a>
        <a href="{{ route('etudiant.gantt') }}" class="btn btn-secondary">
            📊 Mon Gantt
        </a>
        <a href="{{ route('etudiant.rapport') }}" class="btn btn-secondary">
            📁 Mon rapport
        </a>
    </div>
</div>

@endsection