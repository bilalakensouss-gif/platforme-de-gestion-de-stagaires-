@extends('layouts.app')

@section('page_title', 'Suivi — ' . $convention->etudiant->prenom . ' ' . $convention->etudiant->nom)

@section('content')

{{-- Infos étudiant --}}
<div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px; margin-bottom:24px;">
    <div class="card" style="margin-bottom:0;">
        
        <div class="card-body" style="padding:18px;">
            <p style="color:#888; font-size:11px; text-transform:uppercase;
                       letter-spacing:1px; margin-bottom:8px;">Étudiant</p>
            <p style="font-size:17px; font-weight:800; color:#1a3a6b; margin:0;">
                {{ $convention->etudiant->prenom }} {{ $convention->etudiant->nom }}
            </p>
            <p style="color:#888; font-size:12px; margin:4px 0 0;">
                {{ $convention->etudiant->filiere }}
            </p>
        </div>
    </div>

    <div class="card" style="margin-bottom:0;">
        <div class="card-body" style="padding:18px;">
            <p style="color:#888; font-size:11px; text-transform:uppercase;
                       letter-spacing:1px; margin-bottom:8px;">Entreprise</p>
            <p style="font-size:15px; font-weight:700; color:#1a3a6b; margin:0;">
                {{ $convention->entreprise_nom ?? $convention->entreprise?->raison_sociale }}
            </p>
            <p style="color:#888; font-size:12px; margin:4px 0 0;">
                {{ $convention->intitule_stage }}
            </p>
        </div>
    </div>

    <div class="card" style="margin-bottom:0;">
        <div class="card-body" style="padding:18px;">
            <p style="color:#888; font-size:11px; text-transform:uppercase;
                       letter-spacing:1px; margin-bottom:8px;">Période</p>
            <p style="font-size:15px; font-weight:700; color:#1a3a6b; margin:0;">
                {{ $convention->date_debut->format('d/m/Y') }}
            </p>
            <p style="color:#888; font-size:12px; margin:4px 0 0;">
                au {{ $convention->date_fin->format('d/m/Y') }}
            </p>
            @if($convention->rapport)
                <a href="{{ Storage::url($convention->rapport->fichier) }}"
                   target="_blank"
                   style="font-size:11px; color:#2a5298; margin-top:6px;
                          display:inline-block;">
                    📄 Voir le rapport
                </a>
            @endif
        </div>
    </div>
</div>

@if($tasks->count() > 0)

{{-- Progression globale --}}
@php
    $progressionGlobale = round($tasks->avg('progression'));
    $terminees = $tasks->where('statut', 'termine')->count();
    $enCours   = $tasks->where('statut', 'en_cours')->count();
    $total     = $tasks->count();
@endphp

<div class="card" style="margin-bottom:24px;">
    <div class="card-body" style="padding:24px;">
        <div style="display:flex; justify-content:space-between;
                    align-items:center; margin-bottom:16px;">
            <div>
                <h3 style="font-size:16px; font-weight:700; color:#1a3a6b; margin:0;">
                    Progression globale
                </h3>
                <p style="color:#888; font-size:13px; margin:4px 0 0;">
                    {{ $terminees }}/{{ $total }} tâches terminées
                </p>
            </div>
            <div style="font-size:40px; font-weight:800;
                        color:{{ $progressionGlobale == 100 ? '#27ae60' : '#1a3a6b' }};">
                {{ $progressionGlobale }}%
            </div>
        </div>
        <div style="background:#e9ecef; border-radius:50px; height:18px; overflow:hidden;">
            <div style="height:100%; border-radius:50px;
                        width:{{ $progressionGlobale }}%;
                        background:{{ $progressionGlobale == 100
                            ? 'linear-gradient(90deg,#27ae60,#2ecc71)'
                            : 'linear-gradient(90deg,#1a3a6b,#2a5298)' }};
                        transition:width 0.5s ease;">
            </div>
        </div>
        <div style="display:flex; gap:20px; margin-top:14px;">
            <span style="font-size:12px; color:#27ae60; font-weight:600;">
                ✓ {{ $terminees }} terminée(s)
            </span>
            <span style="font-size:12px; color:#f39c12; font-weight:600;">
                ⏳ {{ $enCours }} en cours
            </span>
            <span style="font-size:12px; color:#bbb; font-weight:600;">
                ○ {{ $total - $terminees - $enCours }} non commencée(s)
            </span>
        </div>
    </div>
</div>

{{-- Diagramme — LECTURE SEULE --}}
<div class="card" style="margin-bottom:24px;">
    <div class="card-header">
        <h3>📊 Diagramme de Gantt</h3>
        <span style="font-size:12px; color:#888; background:#f0f0f0;
                     padding:4px 12px; border-radius:20px;">
            👁️ Lecture seule
        </span>
    </div>
    <div class="card-body" style="padding:24px;">

        @foreach($tasks as $index => $task)
        <div style="display:grid; grid-template-columns:220px 1fr 80px;
                    gap:20px; align-items:center;
                    padding:16px 0;
                    border-bottom:{{ !$loop->last ? '1px solid #f0f0f0' : 'none' }};">

            {{-- Nom --}}
            <div style="display:flex; align-items:center; gap:10px;">
                <div style="width:30px; height:30px; border-radius:50%;
                            background:{{ $task->statut === 'termine'
                                ? '#27ae60'
                                : ($task->statut === 'en_cours' ? '#f39c12' : '#dee2e6') }};
                            display:flex; align-items:center; justify-content:center;
                            color:{{ $task->statut === 'non_commence' ? '#999' : 'white' }};
                            font-size:12px; font-weight:700; flex-shrink:0;">
                    @if($task->statut === 'termine') ✓
                    @else {{ $index + 1 }}
                    @endif
                </div>
                <div>
                    <p style="font-weight:600; font-size:13px; margin:0; color:#1a3a6b;">
                        {{ $task->titre }}
                    </p>
                    <p style="color:#aaa; font-size:10px; margin:2px 0 0;">
                        {{ $task->date_debut->format('d/m') }} →
                        {{ $task->date_fin->format('d/m/Y') }}
                    </p>
                </div>
            </div>

            {{-- Barre --}}
            <div>
                <div style="display:flex; justify-content:space-between;
                            margin-bottom:6px;">
                    <span style="font-size:11px;">
                        @if($task->statut === 'termine')
                            <span style="color:#27ae60; font-weight:600;">✓ Terminé</span>
                        @elseif($task->statut === 'en_cours')
                            <span style="color:#f39c12; font-weight:600;">⏳ En cours</span>
                        @else
                            <span style="color:#bbb;">○ Non commencé</span>
                        @endif
                    </span>
                    <span style="font-size:13px; font-weight:700; color:#1a3a6b;">
                        {{ $task->progression }}%
                    </span>
                </div>
                <div style="background:#f0f0f0; border-radius:50px;
                            height:16px; overflow:hidden;">
                    <div style="height:100%; border-radius:50px;
                                width:{{ max($task->progression, 0) }}%;
                                background:{{ $task->progression == 100
                                    ? 'linear-gradient(90deg,#27ae60,#2ecc71)'
                                    : ($task->progression > 0
                                        ? 'linear-gradient(90deg,#1a3a6b,#2a5298)'
                                        : '#dee2e6') }};
                                transition:width 0.5s ease;
                                display:flex; align-items:center;
                                justify-content:center;">
                        @if($task->progression > 10)
                            <span style="color:white; font-size:10px; font-weight:700;">
                                {{ $task->progression }}%
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Pourcentage --}}
            <div style="text-align:center;">
                <div style="font-size:24px; font-weight:800;
                            color:{{ $task->progression == 100 ? '#27ae60' : '#1a3a6b' }};">
                    {{ $task->progression }}%
                </div>
            </div>

        </div>
        @endforeach

    </div>
</div>

{{-- Tableau récapitulatif --}}
<div class="card">
    <div class="card-header">
        <h3>📋 Récapitulatif</h3>
        <a href="{{ route('encadrant.etudiants') }}" class="btn btn-secondary btn-sm">
            ← Retour
        </a>
    </div>
    <div class="card-body" style="padding:0;">
        <table style="width:100%; border-collapse:collapse; font-size:13px;">
            <thead>
                <tr style="background:#f4f6f9;">
                    <th style="padding:14px 16px; text-align:left;
                               border-bottom:2px solid #dee2e6; color:#1a3a6b;
                               font-weight:700;">#</th>
                    <th style="padding:14px 16px; text-align:left;
                               border-bottom:2px solid #dee2e6; color:#1a3a6b;
                               font-weight:700;">Tâche</th>
                    <th style="padding:14px 16px; text-align:left;
                               border-bottom:2px solid #dee2e6; color:#1a3a6b;
                               font-weight:700;">Début</th>
                    <th style="padding:14px 16px; text-align:left;
                               border-bottom:2px solid #dee2e6; color:#1a3a6b;
                               font-weight:700;">Fin</th>
                    <th style="padding:14px 16px; text-align:left;
                               border-bottom:2px solid #dee2e6; color:#1a3a6b;
                               font-weight:700; width:200px;">Avancement</th>
                    <th style="padding:14px 16px; text-align:center;
                               border-bottom:2px solid #dee2e6; color:#1a3a6b;
                               font-weight:700;">Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $index => $task)
                <tr style="border-bottom:1px solid #f0f0f0;
                           background:{{ $task->statut === 'termine' ? '#f9fff9' : 'white' }};">
                    <td style="padding:14px 16px; color:#888; font-weight:600;">
                        {{ $index + 1 }}
                    </td>
                    <td style="padding:14px 16px; font-weight:600; color:#1a3a6b;">
                        {{ $task->titre }}
                    </td>
                    <td style="padding:14px 16px; color:#666;">
                        {{ $task->date_debut->format('d/m/Y') }}
                    </td>
                    <td style="padding:14px 16px; color:#666;">
                        {{ $task->date_fin->format('d/m/Y') }}
                    </td>
                    <td style="padding:14px 16px;">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="flex:1; background:#f0f0f0; border-radius:50px;
                                        height:10px; overflow:hidden;">
                                <div style="height:100%; border-radius:50px;
                                            width:{{ $task->progression }}%;
                                            background:{{ $task->progression == 100
                                                ? '#27ae60'
                                                : ($task->progression > 0
                                                    ? '#2a5298' : '#dee2e6') }};">
                                </div>
                            </div>
                            <span style="font-weight:700; color:#1a3a6b;
                                         font-size:13px; min-width:35px;">
                                {{ $task->progression }}%
                            </span>
                        </div>
                    </td>
                    <td style="padding:14px 16px; text-align:center;">
                        @if($task->statut === 'termine')
                            <span style="background:#d4edda; color:#155724;
                                         padding:5px 14px; border-radius:20px;
                                         font-size:11px; font-weight:700;">
                                ✓ Terminé
                            </span>
                        @elseif($task->statut === 'en_cours')
                            <span style="background:#fff3cd; color:#856404;
                                         padding:5px 14px; border-radius:20px;
                                         font-size:11px; font-weight:700;">
                                En cours
                            </span>
                        @else
                            <span style="background:#f0f0f0; color:#888;
                                         padding:5px 14px; border-radius:20px;
                                         font-size:11px; font-weight:700;">
                                Non commencé
                            </span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@else
<div class="card">
    <div class="card-body" style="text-align:center; padding:40px; color:#999;">
        <p style="font-size:16px; margin-bottom:8px;">📊</p>
        <p>Aucune tâche définie pour cet étudiant.</p>
    </div>
</div>
@endif

@endsection