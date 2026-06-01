@extends('layouts.app')

@section('page_title', 'Créer une convention de stage')

@section('content')

<div class="card" style="max-width:800px;">
    <div class="card-header">
        
        <h3>Nouvelle convention de stage</h3>
        <a href="{{ route('etudiant.convention') }}" class="btn btn-secondary btn-sm">
            ← Retour
        </a>
    </div>
    <div class="card-body">
\\c
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)<p>⚠️ {{ $error }}</p>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('etudiant.convention.store') }}">
            @csrf

            {{-- TYPE DE CONVENTION --}}
            <div style="background:#f8f9ff; padding:16px; border-radius:8px;
                        margin-bottom:20px; border-left:4px solid #1a3a6b;">
                <h4 style="color:#1a3a6b; margin-bottom:12px; font-size:14px;">
                    📋 Informations du stage
                </h4>

                <div class="form-group">
                    <label class="form-label">Type de convention</label>
                    <select name="type" class="form-control" required>
                        <option value="">-- Choisir --</option>
                        <option value="stage_classique"
                            {{ old('type') == 'stage_classique' ? 'selected' : '' }}>
                            TYPE 1 — Stage classique
                        </option>
                        <option value="pfe"
                            {{ old('type') == 'pfe' ? 'selected' : '' }}>
                            TYPE 2 — PFE (Projet de Fin d'Études)
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Intitulé du stage</label>
                    <input type="text" name="intitule_stage" class="form-control"
                           value="{{ old('intitule_stage') }}" required
                           placeholder="Ex: Développement d'une application web">
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
                           value="{{ old('service') }}"
                           placeholder="Ex: Direction Informatique">
                </div>
            </div>

            {{-- INFORMATIONS ENTREPRISE --}}
            <div style="background:#f0fff4; padding:16px; border-radius:8px;
                        margin-bottom:20px; border-left:4px solid #27ae60;">
                <h4 style="color:#1a6b40; margin-bottom:12px; font-size:14px;">
                    🏢 Informations de l'entreprise d'accueil
                </h4>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div class="form-group">
                        <label class="form-label">Nom / Raison sociale *</label>
                        <input type="text" name="entreprise_nom" class="form-control"
                               value="{{ old('entreprise_nom') }}" required
                               placeholder="Ex: ONCF Marrakech">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Secteur d'activité</label>
                        <input type="text" name="entreprise_secteur" class="form-control"
                               value="{{ old('entreprise_secteur') }}"
                               placeholder="Ex: Transport, Informatique...">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Adresse *</label>
                    <input type="text" name="entreprise_adresse" class="form-control"
                           value="{{ old('entreprise_adresse') }}" required
                           placeholder="Ex: Avenue Hassan II, Marrakech">
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div class="form-group">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="entreprise_telephone" class="form-control"
                               value="{{ old('entreprise_telephone') }}"
                               placeholder="+212 5XX XX XX XX">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Fax</label>
                        <input type="text" name="entreprise_fax" class="form-control"
                               value="{{ old('entreprise_fax') }}"
                               placeholder="+212 5XX XX XX XX">
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div class="form-group">
                        <label class="form-label">Email de contact *</label>
                        <input type="email" name="entreprise_email" class="form-control"
                               value="{{ old('entreprise_email') }}" required
                               placeholder="contact@entreprise.ma">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Représentant / Maître de stage</label>
                        <input type="text" name="entreprise_representant"
                               class="form-control"
                               value="{{ old('entreprise_representant') }}"
                               placeholder="Nom du responsable">
                    </div>
                </div>
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