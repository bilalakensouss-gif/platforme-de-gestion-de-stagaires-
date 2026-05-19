<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tableau de bord — Étudiant
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded">{{ session('success') }}</div>
            @endif

            {{-- Info étudiant --}}
            <div class="bg-white rounded shadow p-6">
                <h3 class="font-semibold text-lg mb-2">Mon profil</h3>
                <p><span class="text-gray-500">Nom :</span>
                    {{ auth()->user()->prenom }} {{ auth()->user()->nom }}</p>
                <p><span class="text-gray-500">Filière :</span>
                    {{ auth()->user()->filiere }}</p>
                <p><span class="text-gray-500">Email :</span>
                    {{ auth()->user()->email }}</p>
            </div>

            {{-- État convention --}}
            <div class="bg-white rounded shadow p-6">
                <h3 class="font-semibold text-lg mb-4">Ma convention</h3>
                @if($convention)
                    <div class="flex items-center gap-4">
                        <div>
                            <p><span class="text-gray-500">Type :</span>
                                {{ $convention->type === 'stage_classique' ? 'Stage classique' : 'PFE' }}</p>
                            <p><span class="text-gray-500">Entreprise :</span>
                                {{ $convention->entreprise->raison_sociale }}</p>
                            <p><span class="text-gray-500">État :</span>
                                @if($convention->etat === 'signee')
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Signée ✓</span>
                                @elseif($convention->etat === 'partiellement_signee')
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">En cours</span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Non signée</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('etudiant.convention') }}"
                       class="mt-3 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Voir ma convention
                    </a>
                @else
                    <p class="text-gray-400 mb-3">Aucune convention créée.</p>
                    <a href="{{ route('etudiant.convention.create') }}"
                       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        + Créer une convention
                    </a>
                @endif
            </div>

            {{-- Actions rapides --}}
            <div class="bg-white rounded shadow p-6">
                <h3 class="font-semibold text-lg mb-4">Actions rapides</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('etudiant.demande') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        📄 Demande de stage
                    </a>
                    <a href="{{ route('etudiant.convention') }}"
                       class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                        📋 Ma convention
                    </a>
                    <a href="{{ route('etudiant.rapport') }}"
                       class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700">
                        📁 Mon rapport
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>