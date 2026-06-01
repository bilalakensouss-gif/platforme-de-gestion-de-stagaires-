@extends('layouts.app')

@section('page_title', 'Conventions — ' . auth()->user()->filiere)

@section('content')

<div class="card">
    <div class="card-header">

        <h3>Conventions — Signature Chef (Étape 2)</h3>
        
    </div>
    <div class="card-body" style="padding:0;">
        <table class="fst-table">
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Entreprise</th>
                    <th>Type</th>
                    <th>État</th>
                    <th>Encadrant</th>
                    <th>Signature Chef</th>
                    <th>Actions</th>
                </tr>  \\c
            </thead>
            <tbody>
                @forelse($conventions as $conv)
                <tr>
                    <td>{{ $conv->etudiant->prenom }} {{ $conv->etudiant->nom }}</td>
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
                        @if($conv->encadrant)
                            <span style="color:#27ae60;">
                                {{ $conv->encadrant->prenom }} {{ $conv->encadrant->nom }}
                            </span>
                        @else
                            <form method="POST"
                                  action="{{ route('chef.conventions.affecter', $conv->id) }}"
                                  style="display:flex; gap:5px;">
                                @csrf
                                <select name="encadrant_id" class="form-control"
                                        style="padding:4px 8px; font-size:12px;">
                                    <option value="">-- Choisir --</option>
                                    @foreach($encadrants as $enc)
                                        <option value="{{ $enc->id }}">
                                            {{ $enc->prenom }} {{ $enc->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary btn-xs">OK</button>
                            </form>
                        @endif
                    </td>
                    <td>
                        @if($conv->date_signature_chef)
                            <span style="color:#27ae60;">
                                ✓ {{ $conv->date_signature_chef->format('d/m/Y') }}
                            </span>
                        @else
                            <span style="color:#999;">En attente</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex; flex-direction:column; gap:5px;">
                            <a href="{{ route('chef.conventions.pdf', $conv->id) }}"
                               class="btn btn-secondary btn-xs">📄 PDF</a>
                            @if(!$conv->date_signature_chef && $conv->date_signature_doyen)
                                <form method="POST"
                                      action="{{ route('chef.conventions.signer', $conv->id) }}">
                                    @csrf
                                    <button class="btn btn-success btn-xs">✍️ Signer</button>
                                </form>
                            @elseif(!$conv->date_signature_doyen)
                                <span style="color:#999; font-size:11px;">Attente Doyen</span>
                            @else
                                <span style="color:#999; font-size:11px;">Déjà signé</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;color:#999;padding:30px;">
                        Aucune convention pour votre filière.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection