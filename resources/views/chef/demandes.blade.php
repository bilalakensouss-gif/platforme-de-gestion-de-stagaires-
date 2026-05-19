<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Demandes de stage — {{ auth()->user()->filiere }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded">{{ session('error') }}</div>
        @endif

        {{-- Formulaire dépôt --}}
        <div class="bg-white rounded shadow p-6">
            <h3 class="font-semibold text-lg mb-4">Déposer une nouvelle demande de stage</h3>
            <form method="POST" action="{{ route('chef.demandes.store') }}"
                  enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <x-input-label for="fichier_pdf" value="Fichier PDF de la demande" />
                    <input type="file" id="fichier_pdf" name="fichier_pdf"
                           accept=".pdf"
                           class="block mt-1 w-full border border-gray-300 rounded p-2">
                    <x-input-error :messages="$errors->get('fichier_pdf')" class="mt-2" />
                </div>
                <x-primary-button>Déposer la demande</x-primary-button>
            </form>
        </div>

        {{-- Liste des demandes --}}
        <div class="bg-white rounded shadow p-6">
            <h3 class="font-semibold text-lg mb-4">Demandes déposées</h3>
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left">Date dépôt</th>
                        <th class="p-2 text-left">Filière</th>
                        <th class="p-2 text-left">Fichier</th>
                        <th class="p-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($demandes as $demande)
                    <tr class="border-t">
                        <td class="p-2">{{ $demande->date_depot->format('d/m/Y') }}</td>
                        <td class="p-2">{{ $demande->filiere }}</td>
                        <td class="p-2">
                            <a href="{{ Storage::url($demande->fichier_pdf) }}"
                               target="_blank"
                               class="text-blue-600 hover:underline">
                                📄 Télécharger
                            </a>
                        </td>
                        <td class="p-2">
                            <form method="POST"
                                  action="{{ route('chef.demandes.destroy', $demande->id) }}"
                                  onsubmit="return confirm('Supprimer cette demande ?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 text-xs hover:underline">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-400">
                            Aucune demande déposée.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>