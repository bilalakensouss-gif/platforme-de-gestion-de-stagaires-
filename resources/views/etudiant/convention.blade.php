@extends('layouts.app')

@section('page_title', 'Ma convention de stage')

@section('content')

@if($convention)

    {{-- Infos convention --}}
    <div class="card">
        <div class="card-header">
            <h3>Détails de la convention</h3>
            <a href="{{ route('etudiant.convention.pdf', $convention->id) }}"
               class="btn btn-secondary btn-sm">
                📄 Télécharger PDF
            </a>
        </div>
        <div class="card-body">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                <div>
                    <p style="color:#888; font-size:12px;">Type</p>
                    <p style="font-weight:600;">
                        {{ $convention->type === 'stage_classique'
                            ? 'Stage classique (TYPE 1)'
                            : 'PFE (TYPE 2)' }}
                    </p>
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
                @if($convention->encadrant)
                <div>
                    <p style="color:#888; font-size:12px;">Encadrant</p>
                    <p style="font-weight:600;">
                        {{ $convention->encadrant->prenom }} {{ $convention->encadrant->nom }}
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Circuit de signature --}}
    <div class="card">
        <div class="card-header">
            <h3>Circuit de signature</h3>
            @if($convention->etat === 'signee')
                <span class="badge badge-success">Complètement signée ✓</span>
            @elseif($convention->etat === 'partiellement_signee')
                <span class="badge badge-warning">En cours de signature</span>
            @else
                <span class="badge badge-danger">Non signée</span>
            @endif
        </div>
        <div class="card-body">

            {{-- Étape 1 Doyen --}}
            <div class="circuit-step">
                <div class="circuit-number {{ $convention->date_signature_doyen ? 'done' : 'pending' }}">
                    1
                </div>
                <div style="flex:1;">
                    <p style="font-weight:600; margin:0;">Doyen</p>
                    <p style="color:#888; font-size:12px; margin:2px 0 0;">
                        {{ $convention->date_signature_doyen
                            ? '✓ Signé le '.$convention->date_signature_doyen->format('d/m/Y')
                            : 'En attente' }}
                    </p>
                </div>
            </div>

            {{-- Étape 2 Chef --}}
            <div class="circuit-step">
                <div class="circuit-number {{ $convention->date_signature_chef ? 'done' : 'pending' }}">
                    2
                </div>
                <div style="flex:1;">
                    <p style="font-weight:600; margin:0;">Chef de Filière</p>
                    <p style="color:#888; font-size:12px; margin:2px 0 0;">
                        {{ $convention->date_signature_chef
                            ? '✓ Signé le '.$convention->date_signature_chef->format('d/m/Y')
                            : 'En attente' }}
                    </p>
                </div>
            </div>

            {{-- Étape 3 Étudiant --}}
            <div class="circuit-step">
                <div class="circuit-number {{ $convention->date_signature_etudiant ? 'done' : ($convention->date_signature_chef ? 'current' : 'pending') }}">
                    3
                </div>
                <div style="flex:1;">
                    <p style="font-weight:600; margin:0;">Étudiant</p>
                    <p style="color:#888; font-size:12px; margin:2px 0 0;">
                        {{ $convention->date_signature_etudiant
                            ? '✓ Signé le '.$convention->date_signature_etudiant->format('d/m/Y')
                            : 'En attente' }}
                    </p>
                </div>
                @if(!$convention->date_signature_etudiant && $convention->date_signature_chef)
                    <form method="POST"
                          action="{{ route('etudiant.convention.signer', $convention->id) }}">
                        @csrf
                        <button class="btn btn-primary btn-sm">✍️ Signer maintenant</button>
                    </form>
                @endif
            </div>

            {{-- Étape 4 Entreprise --}}
            <div class="circuit-step">
                <div class="circuit-number {{ $convention->date_signature_entreprise ? 'done' : 'pending' }}">
                    4
                </div>
                <div style="flex:1;">
                    <p style="font-weight:600; margin:0;">Entreprise</p>
                    <p style="color:#888; font-size:12px; margin:2px 0 0;">
                        {{ $convention->date_signature_entreprise
                            ? '✓ Signé le '.$convention->date_signature_entreprise->format('d/m/Y')
                            : 'En attente' }}
                    </p>
                </div>
            </div>

        </div>
    </div>

@else
    <div class="card">
        <div class="card-body" style="text-align:center; padding:40px;">
            <p style="color:#999; margin-bottom:16px; font-size:16px;">
                Vous n'avez pas encore de convention.
            </p>
            <a href="{{ route('etudiant.convention.create') }}" class="btn btn-success">
                + Créer une convention
            </a>
        </div>
    </div>
@endif

@endsection