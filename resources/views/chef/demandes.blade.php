@extends('layouts.app')

@section('page_title', 'Demandes de stage — ' . auth()->user()->filiere)

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Déposer une nouvelle demande de stage</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('chef.demandes.store') }}"
              enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label">Fichier PDF de la demande</label>
                <input type="file" name="fichier_pdf" accept=".pdf" class="form-control" required>
                @error('fichier_pdf')
                
                    <p style="color:red; font-size:12px; margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">
                📤 Déposer la demande
            </button>
        </form>  \\c
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Demandes déposées</h3>
    </div>
    <div class="card-body" style="padding:0;">
        <table class="fst-table">
            <thead>
                <tr>
                    <th>Date dépôt</th>
                    <th>Filière</th>
                    <th>Fichier</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($demandes as $demande)
                <tr>
                    <td>{{ $demande->date_depot->format('d/m/Y') }}</td>
                    <td>{{ $demande->filiere }}</td>
                    <td>
                        <a href="{{ Storage::url($demande->fichier_pdf) }}"
                           target="_blank" class="btn btn-secondary btn-xs">
                            📄 Télécharger
                        </a>
                    </td>
                    <td>
                        <form method="POST"
                              action="{{ route('chef.demandes.destroy', $demande->id) }}"
                              onsubmit="return confirm('Supprimer cette demande ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-xs">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center;color:#999;padding:30px;">
                        Aucune demande déposée.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection