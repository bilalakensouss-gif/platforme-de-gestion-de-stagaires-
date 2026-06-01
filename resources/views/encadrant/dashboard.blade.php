@extends('layouts.app')

@section('page_title', 'Tableau de bord — Encadrant')

@section('content')

<div style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:24px;">
    <div class="stat-box">
        <div class="stat-box-icon" style="background:#e8f0fe;">🎓</div>

        <div>

            <div class="stat-box-number">{{ $stats['etudiants'] }}</div>
            
            <div class="stat-box-label">Étudiants encadrés</div>
        </div>
    </div>  
    <div class="stat-box">
        <div class="stat-box-icon" style="background:#fff3e0;">⏳</div>
        <div>
            <div class="stat-box-number">{{ $stats['en_cours'] }}</div>
            <div class="stat-box-label">Stages en cours</div>
        </div>
    </div>
    <div class="stat-box">
        <div class="stat-box-icon" style="background:#e8f5e9;">✅</div>
        <div>
            <div class="stat-box-number">{{ $stats['termines'] }}</div>
            <div class="stat-box-label">Stages terminés</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Mes étudiants</h3>
        <div style="display:flex; gap:8px;">
            <a href="{{ route('encadrant.etudiants') }}" class="btn btn-primary btn-sm">
                👥 Voir tous
            </a>
            <a href="{{ route('encadrant.gantt') }}" class="btn btn-secondary btn-sm">
                📊 Gantt
            </a>
        </div>
    </div>
    <div class="card-body" style="padding:0;">
        <table class="fst-table">
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Entreprise</th>
                    <th>Type</th>
                    <th>État</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($conventions as $conv)
                <tr>
                    <td>
                        {{ $conv->etudiant->prenom }} {{ $conv->etudiant->nom }}<br>
                        <span style="color:#888; font-size:11px;">{{ $conv->etudiant->filiere }}</span>
                    </td>
                    <td>{{ $conv->entreprise->raison_sociale }}</td>
                    <td>{{ $conv->type === 'stage_classique' ? 'Stage' : 'PFE' }}</td>
                    <td>
                        @if($conv->etat === 'signee')
                            <span class="badge badge-success">Signée</span>
                        @elseif($conv->etat === 'partiellement_signee')
                            <span class="badge badge-warning">En cours</span>
                        @else
                            <span class="badge badge-danger">Non signée</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('encadrant.etudiant.show', $conv->id) }}"
                           class="btn btn-primary btn-xs">
                            Voir détails
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;color:#999;padding:30px;">
                        Aucun étudiant affecté pour le moment.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection