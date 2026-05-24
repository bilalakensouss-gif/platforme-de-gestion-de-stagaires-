@extends('layouts.app')

@section('page_title', 'Détails — ' . $convention->etudiant->prenom . ' ' . $convention->etudiant->nom)

@section('content')

{{-- Infos convention --}}
<div class="card">
    <div class="card-header">
        <h3>Informations du stage</h3>
        <a href="{{ route('encadrant.etudiants') }}" class="btn btn-secondary btn-sm">
            ← Retour
        </a>
    </div>
    <div class="card-body">
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px;">
            <div>
                <p style="color:#888; font-size:12px;">Étudiant</p>
                <p style="font-weight:600;">
                    {{ $convention->etudiant->prenom }} {{ $convention->etudiant->nom }}
                </p>
            </div>
            <div>
                <p style="color:#888; font-size:12px;">Filière</p>
                <p style="font-weight:600;">{{ $convention->etudiant->filiere }}</p>
            </div>
            <div>
                <p style="color:#888; font-size:12px;">Entreprise</p>
                <p style="font-weight:600;">{{ $convention->entreprise->raison_sociale }}</p>
            </div>
            <div>
                <p style="color:#888; font-size:12px;">Intitulé</p>
                <p style="font-weight:600;">{{ $convention->intitule_stage }}</p>
            </div>
            <div>
                <p style="color:#888; font-size:12px;">Période</p>
                <p style="font-weight:600;">
                    {{ $convention->date_debut->format('d/m/Y') }} →
                    {{ $convention->date_fin->format('d/m/Y') }}
                </p>
            </div>
            <div>
                <p style="color:#888; font-size:12px;">Rapport</p>
                @if($convention->rapport)
                    <a href="{{ Storage::url($convention->rapport->fichier) }}"
                       target="_blank" class="btn btn-secondary btn-sm">
                        📄 Télécharger
                    </a>
                @else
                    <p style="color:#999;">Non déposé</p>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Tâches Gantt --}}
<div class="card">
    <div class="card-header">
        <h3>📊 Suivi des tâches</h3>
    </div>
    <div class="card-body">

        @forelse($tasks as $task)
        <div style="margin-bottom:20px; padding:16px; border:1px solid #dee2e6; border-radius:8px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                <div>
                    <p style="font-weight:600; margin:0;">{{ $task->titre }}</p>
                    <p style="color:#888; font-size:11px; margin:2px 0 0;">
                        {{ $task->date_debut->format('d/m/Y') }} →
                        {{ $task->date_fin->format('d/m/Y') }}
                    </p>
                </div>
                @if($task->statut === 'termine')
                    <span class="badge badge-success">✓ Terminé</span>
                @elseif($task->statut === 'en_cours')
                    <span class="badge badge-warning">En cours</span>
                @else
                    <span class="badge badge-gray">Non commencé</span>
                @endif
            </div>

            {{-- Barre de progression --}}
            <div class="progress-bar-container" style="height:16px; margin-bottom:10px;">
                <div class="progress-bar-fill"
                     style="width:{{ max($task->progression, 2) }}%;
                            background:{{ $task->progression == 100 ? '#27ae60' : '#2a5298' }};
                            display:flex; align-items:center; justify-content:center;
                            color:white; font-size:11px;">
                    @if($task->progression > 8) {{ $task->progression }}% @endif
                </div>
            </div>

            {{-- Formulaire mise à jour --}}
            <form method="POST"
                  action="{{ route('encadrant.gantt.update', $task->id) }}"
                  style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                @csrf
                <div style="display:flex; align-items:center; gap:6px;">
                    <label style="font-size:12px; color:#666;">Progression :</label>
                    <input type="number" name="progression"
                           value="{{ $task->progression }}"
                           min="0" max="100"
                           class="form-control"
                           style="width:70px; padding:5px 8px; font-size:13px;">
                    <span style="font-size:12px;">%</span>
                </div>
                <div style="display:flex; align-items:center; gap:6px;">
                    <label style="font-size:12px; color:#666;">Statut :</label>
                    <select name="statut" class="form-control"
                            style="padding:5px 8px; font-size:13px;">
                        <option value="non_commence" {{ $task->statut === 'non_commence' ? 'selected' : '' }}>
                            Non commencé
                        </option>
                        <option value="en_cours" {{ $task->statut === 'en_cours' ? 'selected' : '' }}>
                            En cours
                        </option>
                        <option value="termine" {{ $task->statut === 'termine' ? 'selected' : '' }}>
                            Terminé
                        </option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">
                    💾 Mettre à jour
                </button>
            </form>
        </div>
        @empty
        <p style="text-align:center; color:#999; padding:20px;">Aucune tâche définie.</p>
        @endforelse

    </div>
</div>

@endsection