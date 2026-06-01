@extends('layouts.app')

@section('page_title', 'Mon rapport de stage')

@section('content')

<div class="card" style="max-width:700px;">
    <div class="card-header">
        <h3>Mon rapport de stage</h3>
    </div>

    <div class="card-body">


        @if($rapport)
            <div style="text-align:center; padding:20px;">

                <p style="font-size:16px; margin-bottom:8px;">✅ Rapport déposé</p>
                <p style="color:#888; margin-bottom:16px;">
                    Déposé le {{ $rapport->date_depot->format('d/m/Y') }}
                </p>
                <a href="{{ Storage::url($rapport->fichier) }}"

                   target="_blank" class="btn btn-primary">
                    📄 Télécharger mon rapport
                </a>
            </div>
        @else
            @if($convention)
                <form method="POST" action="{{ route('etudiant.rapport.store') }}"

                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="convention_id" value="{{ $convention->id }}">
                    

                    <div class="form-group">
                        <label class="form-label">Rapport de stage (PDF)</label>
                        <input type="file" name="fichier" accept=".pdf" class="form-control" required>
                        @error('fichier')
                            <p style="color:red; font-size:12px; margin-top:4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        📤 Déposer mon rapport
                    </button>
                </form>
            @else
                <p style="text-align:center; color:#999; padding:20px;">
                    Vous devez avoir une convention signée pour déposer un rapport.
                </p>
            @endif
        @endif

    </div>
</div>

@endsection