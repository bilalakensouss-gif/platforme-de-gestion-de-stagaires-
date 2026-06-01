@extends('layouts.app')

@section('page_title', 'Conventions — Signature Doyen (Étape 1)')

@section('content')

<div class="card">
    <div class="card-header">

        <h3>Conventions — Signature Doyen (Étape 1)</h3>

    </div>
    <div class="card-body" style="padding:0;">

        <table class="fst-table">
            <thead>   
                
                <tr>
                    <th>Étudiant</th>
                    <th>Entreprise</th>
                    <th>Type</th>
                    <th>État</th>
                    <th>Signature Doyen</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($conventions as $conv)
                <tr>
                    {{-- Protection null sur étudiant et entreprise --}}
                    <td>
                        {{ $conv->etudiant->prenom ?? '' }}
                        {{ $conv->etudiant->nom ?? 'Étudiant inconnu' }}
                    </td>
                    <td>
                        {{ $conv->entreprise->raison_sociale ?? 'Entreprise introuvable' }}
                    </td>
                    <td>
                        {{ $conv->type === 'stage_classique' ? 'Stage classique' : 'PFE' }}
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
                        @if($conv->date_signature_doyen)
                            <span style="color:#27ae60;">
                                ✓ {{ $conv->date_signature_doyen->format('d/m/Y') }}
                            </span>
                        @else
                            <span style="color:#999;">En attente</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex; flex-direction:column; gap:5px;">
                            <a href="{{ route('doyen.conventions.pdf', $conv->id) }}"
                               class="btn btn-secondary btn-xs">
                                📄 PDF
                            </a>
                            @if(!$conv->date_signature_doyen)
                                <form method="POST"
                                      action="{{ route('doyen.conventions.signer', $conv->id) }}">
                                    @csrf
                                    <button class="btn btn-primary btn-xs">
                                        ✍️ Signer
                                    </button>
                                </form>
                            @else
                                <span style="color:#999; font-size:11px;">Déjà signé</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; color:#999; padding:30px;">
                        Aucune convention pour le moment.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection