@extends('layouts.app')

@section('page_title', 'Diagramme de Gantt — Suivi global')

@section('content')

@forelse($conventions as $conv)

<div class="card">
    <div class="card-header">
        <div>
            <h3 style="color:#1a3a6b;">
                {{ $conv->etudiant->prenom }} {{ $conv->etudiant->nom }}
            </h3>
            <p style="color:#888; font-size:12px; margin:2px 0 0;">
                {{ $conv->entreprise->raison_sociale }} —
                {{ $conv->date_debut->format('d/m/Y') }} au
                {{ $conv->date_fin->format('d/m/Y') }}
            </p>
        </div>
        <a href="{{ route('encadrant.etudiant.show', $conv->id) }}"
           class="btn btn-primary btn-sm">
            VOIR DÉTAILS
        </a>
    </div>
    <div class="card-body" style="padding:0;">
        <table class="fst-table">
            <thead>
                <tr>
                    <th style="width:200px;">Tâche</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th style="width:300px;">Progression</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $convTasks = $allTasks->where('convention_id', $conv->id);
                @endphp
                @forelse($convTasks as $task)
                <tr>
                    <td style="font-weight:500;">{{ $task->titre }}</td>
                    <td>{{ $task->date_debut->format('d/m/Y') }}</td>
                    <td>{{ $task->date_fin->format('d/m/Y') }}</td>
                    <td>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <div class="progress-bar-container" style="flex:1; height:12px;">
                                <div class="progress-bar-fill"
                                     style="width:{{ $task->progression }}%;
                                            background:{{ $task->progression == 100 ? '#27ae60' : '#2a5298' }};">
                                </div>
                            </div>
                            <span style="font-size:12px; font-weight:600; width:35px;">
                                {{ $task->progression }}%
                            </span>
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
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;color:#999;padding:20px;">
                        Aucune tâche.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@empty
<div class="card">
    <div class="card-body" style="text-align:center; padding:40px; color:#999;">
        Aucun étudiant affecté.
    </div>
</div>
@endforelse

@endsection