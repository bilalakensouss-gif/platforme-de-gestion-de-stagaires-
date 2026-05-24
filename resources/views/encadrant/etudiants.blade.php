@extends('layouts.app')

@section('page_title', 'Mes étudiants encadrés')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Mes étudiants encadrés</h3>
    </div>
    <div class="card-body" style="padding:0;">
        <table class="fst-table">
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Filière</th>
                    <th>Entreprise</th>
                    <th>Période</th>
                    <th>État</th>
                    <th>Rapport</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($conventions as $conv)
                <tr>
                    <td>
                        {{ $conv->etudiant->prenom }} {{ $conv->etudiant->nom }}<br>
                        <span style="color:#888; font-size:11px;">{{ $conv->etudiant->email }}</span>
                    </td>
                    <td>{{ $conv->etudiant->filiere }}</td>
                    <td>{{ $conv->entreprise->raison_sociale }}</td>
                    <td style="font-size:12px;">
                        {{ $conv->date_debut->format('d/m/Y') }}<br>
                        {{ $conv->date_fin->format('d/m/Y') }}
                    </td>
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
                        @if($conv->rapport)
                            <a href="{{ Storage::url($conv->rapport->fichier) }}"
                               target="_blank" class="btn btn-secondary btn-xs">
                                📄 Voir
                            </a>
                        @else
                            <span style="color:#999; font-size:12px;">Non déposé</span>
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
                    <td colspan="7" style="text-align:center;color:#999;padding:30px;">
                        Aucun étudiant affecté.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection