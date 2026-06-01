<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Convention de stage</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">


    <nav class="bg-white border-b px-6 py-4 flex justify-between items-center">

        <span class="font-bold text-lg">🏢 Espace Entreprise</span>
        <a href="{{ route('entreprise.convention') }}"
        
           class="text-sm text-blue-600 hover:underline">
            ← Retour
        </a>
    </nav>
\\c
    <div class="max-w-4xl mx-auto py-6 px-4">
        <div class="bg-white rounded shadow p-8">

            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold">CONVENTION DE STAGE</h1>
                <p class="text-gray-500">
                    {{ $convention->type === 'stage_classique' ? 'Stage Classique — TYPE 1' : 'Projet de Fin d\'Études — TYPE 2' }}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="font-semibold mb-2 border-b pb-1">Étudiant</h3>
                    <p>{{ $convention->etudiant->prenom }} {{ $convention->etudiant->nom }}</p>
                    <p class="text-gray-500">{{ $convention->etudiant->filiere }}</p>
                    <p class="text-gray-500">{{ $convention->etudiant->email }}</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-2 border-b pb-1">Entreprise</h3>
                    <p>{{ $convention->entreprise->raison_sociale }}</p>
                    <p class="text-gray-500">{{ $convention->entreprise->adresse }}</p>
                    <p class="text-gray-500">{{ $convention->entreprise->secteur }}</p>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="font-semibold mb-2 border-b pb-1">Informations du stage</h3>
                <p><span class="text-gray-500">Intitulé :</span> {{ $convention->intitule_stage }}</p>
                <p><span class="text-gray-500">Période :</span>
                    {{ $convention->date_debut->format('d/m/Y') }} au {{ $convention->date_fin->format('d/m/Y') }}</p>
                @if($convention->service)
                    <p><span class="text-gray-500">Service :</span> {{ $convention->service }}</p>
                @endif
                @if($convention->maitre_stage)
                    <p><span class="text-gray-500">Maître de stage :</span> {{ $convention->maitre_stage }}</p>
                @endif
                @if($convention->encadrant)
                    <p><span class="text-gray-500">Encadrant :</span>
                        {{ $convention->encadrant->prenom }} {{ $convention->encadrant->nom }}</p>
                @endif
            </div>

            {{-- Circuit de signature --}}
            <div class="mb-6">
                <h3 class="font-semibold mb-2 border-b pb-1">Signatures</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="border rounded p-3 text-center">
                        <p class="font-medium">Doyen</p>
                        @if($convention->date_signature_doyen)
                            <p class="text-green-600 text-sm">✓ Signé le {{ $convention->date_signature_doyen->format('d/m/Y') }}</p>
                        @else
                            <p class="text-gray-400 text-sm">En attente</p>
                        @endif
                    </div>
                    <div class="border rounded p-3 text-center">
                        <p class="font-medium">Chef de Filière</p>
                        @if($convention->date_signature_chef)
                            <p class="text-green-600 text-sm">✓ Signé le {{ $convention->date_signature_chef->format('d/m/Y') }}</p>
                        @else
                            <p class="text-gray-400 text-sm">En attente</p>
                        @endif
                    </div>
                    <div class="border rounded p-3 text-center">
                        <p class="font-medium">Étudiant</p>
                        @if($convention->date_signature_etudiant)
                            <p class="text-green-600 text-sm">✓ Signé le {{ $convention->date_signature_etudiant->format('d/m/Y') }}</p>
                        @else
                            <p class="text-gray-400 text-sm">En attente</p>
                        @endif
                    </div>
                    <div class="border rounded p-3 text-center">
                        <p class="font-medium">Entreprise</p>
                        @if($convention->date_signature_entreprise)
                            <p class="text-green-600 text-sm">✓ Signé le {{ $convention->date_signature_entreprise->format('d/m/Y') }}</p>
                        @else
                            <p class="text-gray-400 text-sm">En attente</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <button onclick="window.print()"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    🖨️ Imprimer
                </button>
                <a href="{{ route('entreprise.convention') }}"
                   class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">
                    ← Retour
                </a>
            </div>

        </div>
    </div>
</body>
</html>