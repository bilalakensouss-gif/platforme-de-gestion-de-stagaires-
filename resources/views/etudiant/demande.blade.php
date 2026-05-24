@extends('layouts.app')

@section('page_title', 'Demande de stage')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Demandes disponibles — {{ auth()->user()->filiere }}</h3>
    </div>
    <div class="card-body" style="padding:0;">
        <table class="fst-table">
            <thead>
                <tr>
                    <th>Date dépôt</th>
                    <th>Filière</th>
                    <th>Télécharger</th>
                </tr>
            </thead>
            <tbody>
                @forelse($demandes as $demande)
                <tr>
                    <td>{{ $demande->date_depot->format('d/m/Y') }}</td>
                    <td>{{ $demande->filiere }}</td>
                    <td>
                        <a href="{{ Storage::url($demande->fichier_pdf) }}"
                           target="_blank" class="btn btn-primary btn-sm">
                            📄 Télécharger
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align:center;color:#999;padding:30px;">
                        Aucune demande disponible pour votre filière.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection