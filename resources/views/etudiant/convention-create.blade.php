@extends('layouts.app')

@section('page_title', 'Créer une convention de stage')

@section('content')

<div class="card" style="max-width:750px;">
    <div class="card-header">
        <h3>Nouvelle convention de stage</h3>
        <a href="{{ route('etudiant.convention') }}" class="btn btn-secondary btn-sm">
            ← Retour
        </a>
    </div>
    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('etudiant.convention.store') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Type de convention</label>
                <select name="type" class="form-control" required>
                    <option value="">-- Choisir --</option>
                    <option value="stage_classique" {{ old('type') == 'stage_classique' ? 'selected' : '' }}>
                        TYPE 1 — Stage classique
                    </option>
                    <option value="pfe" {{ old('type') == 'pfe' ? 'selected' : '' }}>
                        TYPE 2 — PFE (Projet de Fin d'Études)
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Entreprise d'accueil</label>
                <select name="entreprise_id" class="form-control" required>
                    <option value="">-- Choisir l'entreprise --</option>
                    @foreach($entreprises as $ent)
                        <option value="{{ $ent->id }}"
                            {{ old('entreprise_id') == $ent->id ? 'selected' : '' }}>
                            {{ $ent->raison_sociale }} — {{ $ent->secteur }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Intitulé du stage</label>
                <input type="text" name="intitule_stage" class="form-control"
                       value="{{ old('intitule_stage') }}" required>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                <div class="form-group">
                    <label class="form-label">Date de début</label>
                    <input type="date" name="date_debut" class="form-control"
                           value="{{ old('date_debut') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Date de fin</label>
                    <input type="date" name="date_fin" class="form-control"
                           value="{{ old('date_fin') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Service / Département (optionnel)</label>
                <input type="text" name="service" class="form-control"
                       value="{{ old('service') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Maître de stage (optionnel)</label>
                <input type="text" name="maitre_stage" class="form-control"
                       value="{{ old('maitre_stage') }}">
            </div>

            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit" class="btn btn-primary">
                    💾 Créer la convention
                </button>
                <a href="{{ route('etudiant.convention') }}" class="btn btn-secondary">
                    Annuler
                </a>
            </div>

        </form>
    </div>
</div>

@endsection