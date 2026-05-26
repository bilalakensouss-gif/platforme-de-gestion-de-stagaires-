@extends('layouts.app')

@section('page_title', 'Mon Diagramme de Gantt')

@section('content')

@if($convention)

    {{-- Infos encadrant --}}
    <div class="card">
        <div class="card-body">
            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px;">
                <div>
                    <p style="color:#888; font-size:12px; margin-bottom:4px;">Mon encadrant</p>
                    @if($convention->encadrant)
                        <p style="font-size:18px; font-weight:700; color:#1a3a6b; margin:0;">
                            {{ $convention->encadrant->prenom }}
                            {{ $convention->encadrant->nom }}
                        </p>
                        <p style="color:#888; font-size:12px; margin:2px 0 0;">
                            {{ $convention->encadrant->specialite }}
                        </p>
                    @else
                        <p style="color:#999; font-style:italic;">Pas encore affecté</p>
                    @endif
                </div>
                <div>
                    <p style="color:#888; font-size:12px; margin-bottom:4px;">Stage</p>
                    <p style="font-weight:600; margin:0;">{{ $convention->intitule_stage }}</p>
                    <p style="color:#888; font-size:12px; margin:2px 0 0;">
                        {{ $convention->entreprise->raison_sociale }}
                    </p>
                </div>
                <div>
                    <p style="color:#888; font-size:12px; margin-bottom:4px;">Période</p>
                    <p style="font-weight:600; margin:0;">
                        {{ $convention->date_debut->format('d/m/Y') }} →
                        {{ $convention->date_fin->format('d/m/Y') }}
                    </p>
                    <p style="color:#888; font-size:12px; margin:2px 0 0;">
                        {{ $convention->date_debut->diffInDays($convention->date_fin) }} jours
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Progression globale --}}
    @if($tasks->count() > 0)
    @php $progressionGlobale = round($tasks->avg('progression')); @endphp
    <div class="card">
        <div class="card-body">
            <div style="display:flex; justify-content:space-between;
                        align-items:center; margin-bottom:10px;">
                <span style="font-weight:600;">Progression globale</span>
                <span style="font-size:24px; font-weight:700; color:#1a3a6b;">
                    {{ $progressionGlobale }}%
                </span>
            </div>
            <div class="progress-bar-container" style="height:14px;">
                <div class="progress-bar-fill"
                     style="width:{{ $progressionGlobale }}%;
                            background:{{ $progressionGlobale == 100
                                ? '#27ae60' : '#1a3a6b' }};">
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Tâches Gantt — MODIFIABLE par l'étudiant --}}
    <div class="card">
        <div class="card-header">
            <h3>📊 Mon Diagramme de Gantt</h3>
            <span style="font-size:12px; color:#27ae60; font-weight:600;">
                ✏️ Vous pouvez modifier votre progression
            </span>
        </div>
        <div class="card-body">

            @forelse($tasks as $task)
            <div style="margin-bottom:20px; padding:16px;
                        border:1px solid #dee2e6; border-radius:8px;">

                <div style="display:flex; justify-content:space-between;
                            align-items:center; margin-bottom:8px;">
                    <div>
                        <p style="font-weight:600; margin:0; font-size:14px;">
                            {{ $task->titre }}
                        </p>
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
                <div class="progress-bar-container" style="height:20px; margin-bottom:12px;">
                    <div class="progress-bar-fill"
                         style="width:{{ max($task->progression, 2) }}%;
                                background:{{ $task->progression == 100
                                    ? '#27ae60'
                                    : ($task->progression > 0 ? '#2a5298' : '#dee2e6') }};
                                display:flex; align-items:center;
                                justify-content:center; color:white;
                                font-size:11px; font-weight:600;">
                        @if($task->progression > 8) {{ $task->progression }}% @endif
                    </div>
                </div>

                {{-- Formulaire mise à jour — ETUDIANT SEULEMENT --}}
                <form method="POST"
                      action="{{ route('etudiant.gantt.update', $task->id) }}"
                      style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                    @csrf
                    <div style="display:flex; align-items:center; gap:6px;">
                        <label style="font-size:12px; color:#666; font-weight:600;">
                            Progression :
                        </label>
                        <input type="number" name="progression"
                               value="{{ $task->progression }}"
                               min="0" max="100"
                               class="form-control"
                               style="width:70px; padding:5px 8px; font-size:13px;">
                        <span style="font-size:12px; color:#666;">%</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:6px;">
                        <label style="font-size:12px; color:#666; font-weight:600;">
                            Statut :
                        </label>
                        <select name="statut" class="form-control"
                                style="padding:5px 8px; font-size:13px;">
                            <option value="non_commence"
                                {{ $task->statut === 'non_commence' ? 'selected' : '' }}>
                                Non commencé
                            </option>
                            <option value="en_cours"
                                {{ $task->statut === 'en_cours' ? 'selected' : '' }}>
                                En cours
                            </option>
                            <option value="termine"
                                {{ $task->statut === 'termine' ? 'selected' : '' }}>
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
            <p style="text-align:center; color:#999; padding:20px;">
                Aucune tâche définie pour le moment.
            </p>
            @endforelse

        </div>
    </div>

    {{-- Tableau récapitulatif --}}
    @if($tasks->count() > 0)
    <div class="card">
        <div class="card-header"><h3>Récapitulatif des tâches</h3></div>
        <div class="card-body" style="padding:0;">
            <table class="fst-table">
                <thead>
                    <tr>
                        <th>Tâche</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Progression</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->titre }}</td>
                        <td>{{ $task->date_debut->format('d/m/Y') }}</td>
                        <td>{{ $task->date_fin->format('d/m/Y') }}</td>
                        <td>
                            <div style="display:flex; align-items:center; gap:8px;">
                                <div class="progress-bar-container"
                                     style="width:80px; height:8px;">
                                    <div class="progress-bar-fill"
                                         style="width:{{ $task->progression }}%;
                                                background:{{ $task->progression == 100
                                                    ? '#27ae60' : '#2a5298' }};">
                                    </div>
                                </div>
                                <span style="font-size:12px;">{{ $task->progression }}%</span>
                            </div>
                        </td>
                        <td>
                            @if($task->statut === 'termine')
                                <span class="badge badge-success">Terminé</span>
                            @elseif($task->statut === 'en_cours')
                                <span class="badge badge-warning">En cours</span>
                            @else
                                <span class="badge badge-gray">Non commencé</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

@else
    <div class="card">
        <div class="card-body" style="text-align:center; padding:40px;">
            <p style="color:#999; margin-bottom:16px;">
                Vous n'avez pas encore de convention de stage.
            </p>
            <a href="{{ route('etudiant.convention.create') }}" class="btn btn-success">
                + Créer une convention
            </a>
        </div>
    </div>
@endif

@endsection