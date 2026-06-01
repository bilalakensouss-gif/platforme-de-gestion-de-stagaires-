@extends('layouts.app')

@section('page_title', 'Ajouter une entreprise')

@section('content')

<div class="card" style="max-width:700px;">
    <div class="card-header">
        <h3>Nouvelle entreprise</h3>
        <a href="{{ route('doyen.utilisateurs') }}" class="btn btn-secondary btn-sm">
            ← Retour
        </a>
    </div>
    <div class="card-body">
\\c
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('doyen.entreprises.store') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Raison sociale</label>
                <input type="text" name="raison_sociale" class="form-control"
                       value="{{ old('raison_sociale') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Adresse</label>
                <input type="text" name="adresse" class="form-control"
                       value="{{ old('adresse') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Secteur d'activité</label>
                <input type="text" name="secteur" class="form-control"
                       value="{{ old('secteur') }}">
            </div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
    <div class="form-group">
        <label class="form-label">Téléphone</label>
        <input type="text" name="telephone" class="form-control"
               value="{{ old('telephone') }}"
               placeholder="+212 5XX XX XX XX">
    </div>
    <div class="form-group">
        <label class="form-label">Fax</label>
        <input type="text" name="fax" class="form-control"
               value="{{ old('fax') }}"
               placeholder="+212 5XX XX XX XX">
    </div>
</div>

<div class="form-group">
    <label class="form-label">Représentant / Responsable</label>
    <input type="text" name="representant" class="form-control"
           value="{{ old('representant') }}"
           placeholder="Nom du responsable">
</div>

            <div class="form-group">
                <label class="form-label">Email de contact</label>
                <input type="email" name="email_contact" class="form-control"
                       value="{{ old('email_contact') }}" required>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                <div class="form-group">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation"
                           class="form-control" required>
                </div>
            </div>

            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit" class="btn btn-primary">
                    💾 Créer l'entreprise
                </button>
                <a href="{{ route('doyen.utilisateurs') }}" class="btn btn-secondary">
                    Annuler
                </a>
            </div>

        </form>
    </div>
</div>

@endsection