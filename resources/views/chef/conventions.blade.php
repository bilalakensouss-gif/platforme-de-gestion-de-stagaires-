<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Conventions — {{ auth()->user()->filiere }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded shadow p-6">

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
            @endif

            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left">Étudiant</th>
                        <th class="p-2 text-left">Entreprise</th>
                        <th class="p-2 text-left">Type</th>
                        <th class="p-2 text-left">État</th>
                        <th class="p-2 text-left">Encadrant</th>
                        <th class="p-2 text-left">Signature Chef</th>
                        <th class="p-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($conventions as $conv)
                    <tr class="border-t">
                        <td class="p-2">
                            {{ $conv->etudiant->prenom }} {{ $conv->etudiant->nom }}
                        </td>
                        <td class="p-2">{{ $conv->entreprise->raison_sociale }}</td>
                        <td class="p-2">
                            {{ $conv->type === 'stage_classique' ? 'Stage classique' : 'PFE' }}
                        </td>
                        <td class="p-2">
                            @if($conv->etat === 'signee')
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Signée</span>
                            @elseif($conv->etat === 'partiellement_signee')
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">En cours</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Non signée</span>
                            @endif
                        </td>

                        {{-- Affectation encadrant --}}
                        <td class="p-2">
                            @if($conv->encadrant)
                                <span class="text-green-600">
                                    {{ $conv->encadrant->prenom }} {{ $conv->encadrant->nom }}
                                </span>
                            @else
                                <form method="POST"
                                      action="{{ route('chef.conventions.affecter', $conv->id) }}"
                                      class="flex gap-1">
                                    @csrf
                                    <select name="encadrant_id"
                                            class="border rounded text-xs p-1">
                                        <option value="">-- Choisir --</option>
                                        @foreach($encadrants as $enc)
                                            <option value="{{ $enc->id }}">
                                                {{ $enc->prenom }} {{ $enc->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button class="bg-blue-600 text-white px-2 py-1 rounded text-xs">
                                        Affecter
                                    </button>
                                </form>
                            @endif
                        </td>

                        {{-- Signature Chef --}}
                        <td class="p-2">
                            @if($conv->date_signature_chef)
                                <span class="text-green-600">
                                    ✓ {{ $conv->date_signature_chef->format('d/m/Y') }}
                                </span>
                            @else
                                <span class="text-gray-400">En attente</span>
                            @endif
                        </td>

                        {{-- Action signer --}}
                        <td class="p-2">
                            @if(!$conv->date_signature_chef && $conv->date_signature_doyen)
                                <form method="POST"
                                      action="{{ route('chef.conventions.signer', $conv->id) }}">
                                    @csrf
                                    <button class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700">
                                        Signer
                                    </button>
                                </form>
                            @elseif(!$conv->date_signature_doyen)
                                <span class="text-gray-400 text-xs">Attente Doyen</span>
                            @else
                                <span class="text-gray-400 text-xs">Déjà signé</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-4 text-center text-gray-400">
                            Aucune convention pour votre filière.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>