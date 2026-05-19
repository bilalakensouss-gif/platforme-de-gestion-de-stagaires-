<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ma convention de stage
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded">{{ session('error') }}</div>
        @endif

        @if($convention)

            {{-- Informations convention --}}
            <div class="bg-white rounded shadow p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="font-semibold text-lg">Détails de la convention</h3>
                    <a href="{{ route('etudiant.convention.pdf', $convention->id) }}"
                       class="bg-gray-600 text-white px-3 py-1 rounded text-sm hover:bg-gray-700">
                        📄 Télécharger PDF
                    </a>
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Type</p>
                        <p class="font-medium">
                            {{ $convention->type === 'stage_classique' ? 'Stage classique (TYPE 1)' : 'PFE (TYPE 2)' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500">Entreprise</p>
                        <p class="font-medium">{{ $convention->entreprise->raison_sociale }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Intitulé</p>
                        <p class="font-medium">{{ $convention->intitule_stage }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Période</p>
                        <p class="font-medium">
                            {{ $convention->date_debut->format('d/m/Y') }} →
                            {{ $convention->date_fin->format('d/m/Y') }}
                        </p>
                    </div>
                    @if($convention->encadrant)
                    <div>
                        <p class="text-gray-500">Encadrant</p>
                        <p class="font-medium">
                            {{ $convention->encadrant->prenom }} {{ $convention->encadrant->nom }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Circuit de signature --}}
            <div class="bg-white rounded shadow p-6">
                <h3 class="font-semibold text-lg mb-4">Circuit de signature</h3>

                <div class="space-y-3">
                    {{-- Étape 1 Doyen --}}
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center
                            {{ $convention->date_signature_doyen ? 'bg-green-500' : 'bg-gray-300' }} text-white font-bold">
                            1
                        </div>
                        <div>
                            <p class="font-medium">Doyen</p>
                            <p class="text-xs text-gray-500">
                                {{ $convention->date_signature_doyen
                                    ? '✓ Signé le '.$convention->date_signature_doyen->format('d/m/Y')
                                    : 'En attente' }}
                            </p>
                        </div>
                    </div>

                    {{-- Étape 2 Chef --}}
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center
                            {{ $convention->date_signature_chef ? 'bg-green-500' : 'bg-gray-300' }} text-white font-bold">
                            2
                        </div>
                        <div>
                            <p class="font-medium">Chef de Filière</p>
                            <p class="text-xs text-gray-500">
                                {{ $convention->date_signature_chef
                                    ? '✓ Signé le '.$convention->date_signature_chef->format('d/m/Y')
                                    : 'En attente' }}
                            </p>
                        </div>
                    </div>

                    {{-- Étape 3 Étudiant --}}
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center
                            {{ $convention->date_signature_etudiant ? 'bg-green-500' : 'bg-gray-300' }} text-white font-bold">
                            3
                        </div>
                        <div>
                            <p class="font-medium">Étudiant</p>
                            <p class="text-xs text-gray-500">
                                {{ $convention->date_signature_etudiant
                                    ? '✓ Signé le '.$convention->date_signature_etudiant->format('d/m/Y')
                                    : 'En attente' }}
                            </p>
                        </div>
                        {{-- Bouton signer étudiant --}}
                        @if(!$convention->date_signature_etudiant && $convention->date_signature_chef)
                            <form method="POST"
                                  action="{{ route('etudiant.convention.signer', $convention->id) }}">
                                @csrf
                                <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                    Signer maintenant
                                </button>
                            </form>
                        @endif
                    </div>

                    {{-- Étape 4 Entreprise --}}
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center
                            {{ $convention->date_signature_entreprise ? 'bg-green-500' : 'bg-gray-300' }} text-white font-bold">
                            4
                        </div>
                        <div>
                            <p class="font-medium">Entreprise</p>
                            <p class="text-xs text-gray-500">
                                {{ $convention->date_signature_entreprise
                                    ? '✓ Signé le '.$convention->date_signature_entreprise->format('d/m/Y')
                                    : 'En attente' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <div class="bg-white rounded shadow p-6 text-center">
                <p class="text-gray-400 mb-4">Vous n'avez pas encore de convention.</p>
                <a href="{{ route('etudiant.convention.create') }}"
                   class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    + Créer une convention
                </a>
            </div>
        @endif

    </div>
</x-app-layout>