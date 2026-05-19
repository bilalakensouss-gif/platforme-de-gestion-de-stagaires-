<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des utilisateurs
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded">{{ session('success') }}</div>
        @endif

        {{-- Encadrants --}}
        <div class="bg-white rounded shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Encadrants</h3>
                <a href="{{ route('doyen.encadrants.create') }}"
                   class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                    + Ajouter
                </a>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left">Nom</th>
                        <th class="p-2 text-left">Email</th>
                        <th class="p-2 text-left">Spécialité</th>
                        <th class="p-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($encadrants as $enc)
                    <tr class="border-t">
                        <td class="p-2">{{ $enc->prenom }} {{ $enc->nom }}</td>
                        <td class="p-2">{{ $enc->email }}</td>
                        <td class="p-2">{{ $enc->specialite }}</td>
                        <td class="p-2">
                            <form method="POST" action="{{ route('doyen.encadrants.destroy', $enc->id) }}"
                                  onsubmit="return confirm('Supprimer ?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 text-xs hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="p-2 text-gray-400">Aucun encadrant.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Chefs de filière --}}
        <div class="bg-white rounded shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Chefs de filière</h3>
                <a href="{{ route('doyen.chefs.create') }}"
                   class="bg-purple-600 text-white px-3 py-1 rounded text-sm hover:bg-purple-700">
                    + Ajouter
                </a>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left">Nom</th>
                        <th class="p-2 text-left">Email</th>
                        <th class="p-2 text-left">Filière</th>
                        <th class="p-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($chefs as $chef)
                    <tr class="border-t">
                        <td class="p-2">{{ $chef->prenom }} {{ $chef->nom }}</td>
                        <td class="p-2">{{ $chef->email }}</td>
                        <td class="p-2">{{ $chef->filiere }}</td>
                        <td class="p-2">
                            <form method="POST" action="{{ route('doyen.chefs.destroy', $chef->id) }}"
                                  onsubmit="return confirm('Supprimer ?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 text-xs hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="p-2 text-gray-400">Aucun chef de filière.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Entreprises --}}
        <div class="bg-white rounded shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Entreprises</h3>
                <a href="{{ route('doyen.entreprises.create') }}"
                   class="bg-orange-600 text-white px-3 py-1 rounded text-sm hover:bg-orange-700">
                    + Ajouter
                </a>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left">Raison sociale</th>
                        <th class="p-2 text-left">Email</th>
                        <th class="p-2 text-left">Secteur</th>
                        <th class="p-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($entreprises as $ent)
                    <tr class="border-t">
                        <td class="p-2">{{ $ent->raison_sociale }}</td>
                        <td class="p-2">{{ $ent->email_contact }}</td>
                        <td class="p-2">{{ $ent->secteur }}</td>
                        <td class="p-2">
                            <form method="POST" action="{{ route('doyen.entreprises.destroy', $ent->id) }}"
                                  onsubmit="return confirm('Supprimer ?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 text-xs hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="p-2 text-gray-400">Aucune entreprise.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Étudiants --}}
        <div class="bg-white rounded shadow p-6">
            <h3 class="font-semibold text-lg mb-4">Étudiants inscrits</h3>
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left">Nom</th>
                        <th class="p-2 text-left">Email</th>
                        <th class="p-2 text-left">Filière</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($etudiants as $etu)
                    <tr class="border-t">
                        <td class="p-2">{{ $etu->prenom }} {{ $etu->nom }}</td>
                        <td class="p-2">{{ $etu->email }}</td>
                        <td class="p-2">{{ $etu->filiere }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="p-2 text-gray-400">Aucun étudiant.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>