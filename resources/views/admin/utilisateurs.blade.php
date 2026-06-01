@extends('layouts.app')

@section('page_title', 'Gestion des utilisateurs')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>

    @endif

    {{-- Doyens --}}

    <div class="card">
        <div class="card-header">
            <h3>Doyens</h3>
            
            <a href="{{ route('admin.doyens.create') }}" class="btn btn-primary btn-sm">
                + Ajouter
            </a>
        </div>
        <div class="card-body" style="padding:0;">
            <table class="fst-table">
                <thead>
                    <tr>  \\c
                        <th>Nom</th><th>Email</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($doyens as $doyen)
                    <tr>
                        <td>{{ $doyen->prenom }} {{ $doyen->nom }}</td>
                        <td>{{ $doyen->email }}</td>
                        <td>
                            <form method="POST"
                                  action="{{ route('admin.doyens.destroy', $doyen->id) }}"
                                  onsubmit="return confirm('Supprimer ?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-xs">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" style="text-align:center;color:#999;padding:20px;">
                        Aucun doyen.
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Encadrants --}}
    <div class="card">
        <div class="card-header">
            <h3>Encadrants</h3>
            <a href="{{ route('admin.encadrants.create') }}" class="btn btn-primary btn-sm">
                + Ajouter
            </a>
        </div>
        <div class="card-body" style="padding:0;">
            <table class="fst-table">
                <thead>
                    <tr>
                        <th>Nom</th><th>Email</th><th>Spécialité</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($encadrants as $enc)
                    <tr>
                        <td>{{ $enc->prenom }} {{ $enc->nom }}</td>
                        <td>{{ $enc->email }}</td>
                        <td>{{ $enc->specialite }}</td>
                        <td>
                            <form method="POST"
                                  action="{{ route('admin.encadrants.destroy', $enc->id) }}"
                                  onsubmit="return confirm('Supprimer ?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-xs">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center;color:#999;padding:20px;">
                        Aucun encadrant.
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Chefs de filière --}}
    <div class="card">
        <div class="card-header">
            <h3>Chefs de filière</h3>
            <a href="{{ route('admin.chefs.create') }}" class="btn btn-primary btn-sm">
                + Ajouter
            </a>
        </div>
        <div class="card-body" style="padding:0;">
            <table class="fst-table">
                <thead>
                    <tr>
                        <th>Nom</th><th>Email</th><th>Filière</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($chefs as $chef)
                    <tr>
                        <td>{{ $chef->prenom }} {{ $chef->nom }}</td>
                        <td>{{ $chef->email }}</td>
                        <td>{{ $chef->filiere }}</td>
                        <td>
                            <form method="POST"
                                  action="{{ route('admin.chefs.destroy', $chef->id) }}"
                                  onsubmit="return confirm('Supprimer ?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-xs">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center;color:#999;padding:20px;">
                        Aucun chef de filière.
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Étudiants --}}
    <div class="card">
        <div class="card-header"><h3>Étudiants inscrits</h3></div>
        <div class="card-body" style="padding:0;">
            <table class="fst-table">
                <thead>
                    <tr><th>Nom</th><th>Email</th><th>Filière</th></tr>
                </thead>
                <tbody>
                    @forelse($etudiants as $etu)
                    <tr>
                        <td>{{ $etu->prenom }} {{ $etu->nom }}</td>
                        <td>{{ $etu->email }}</td>
                        <td>{{ $etu->filiere }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" style="text-align:center;color:#999;padding:20px;">
                        Aucun étudiant.
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection