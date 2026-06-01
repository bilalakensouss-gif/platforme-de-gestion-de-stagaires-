@extends('layouts.app')

@section('page_title', 'Ajouter un chef de filière')

@section('content')

<div class="card" style="max-width:700px;">

    <div class="card-header">

        <h3>Nouveau chef de filière</h3>

        <a href="{{ route('doyen.utilisateurs') }}" class="btn btn-secondary btn-sm">
            ← Retour
        </a>
    </div>
    <div class="card-body">

        @if($errors->any())
        
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('doyen.chefs.store') }}">
            @csrf

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                <div class="form-group">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control"
                           value="{{ old('nom') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control"
                           value="{{ old('prenom') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Filière</label>
                <select name="filiere" class="form-control" required>
                    <option value="">-- Choisir --</option>
                    <option value="Génie Informatique" {{ old('filiere') == 'Génie Informatique' ? 'selected' : '' }}>
                        Génie Informatique
                    </option>
                    <option value="Génie Électrique" {{ old('filiere') == 'Génie Électrique' ? 'selected' : '' }}>
                        Génie Électrique
                    </option>
                    <option value="Génie Civil" {{ old('filiere') == 'Génie Civil' ? 'selected' : '' }}>
                        Génie Civil
                    </option>
                    <option value="Génie Mécanique" {{ old('filiere') == 'Génie Mécanique' ? 'selected' : '' }}>
                        Génie Mécanique
                    </option>
                </select>
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
                    💾 Créer le chef de filière
                </button>
                <a href="{{ route('doyen.utilisateurs') }}" class="btn btn-secondary">
                    Annuler
                </a>
            </div>

        </form>
    </div>
</div>

@endsection