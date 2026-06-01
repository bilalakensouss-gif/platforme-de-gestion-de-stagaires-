@extends('layouts.app')

@section('page_title', 'Entreprises')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

<div class="card">
    <div class="card-header">
        <h3>Entreprises enregistrées</h3>
        <a href="{{ route('admin.entreprises.create') }}" class="btn btn-primary btn-sm">
            + Ajouter
        </a>
    </div>
    <div class="card-body" style="padding:0;">
        <table class="fst-table">
            <thead>  \\c
                <tr>
                    <th>Raison sociale</th>
                    <th>Email</th>
                    <th>Secteur</th>
                    <th>Adresse</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($entreprises as $ent)
                <tr>
                    <td>{{ $ent->raison_sociale }}</td>
                    <td>{{ $ent->email_contact }}</td>
                    <td>{{ $ent->secteur ?? '—' }}</td>
                    <td>{{ $ent->adresse }}</td>
                    <td>
                        <form method="POST"
                              action="{{ route('admin.entreprises.destroy', $ent->id) }}"
                              onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-xs">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;color:#999;padding:30px;">
                        Aucune entreprise enregistrée.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection