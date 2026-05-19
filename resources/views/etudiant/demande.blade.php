<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Demande de stage — {{ auth()->user()->filiere }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded shadow p-6">
            <h3 class="font-semibold text-lg mb-4">
                Demandes disponibles pour votre filière
            </h3>
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left">Date dépôt</th>
                        <th class="p-2 text-left">Filière</th>
                        <th class="p-2 text-left">Télécharger</th>
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
                               class="bg-blue-600 text-white px-3 py-1 rounded text-xs hover:bg-blue-700">
                                📄 Télécharger
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-400">
                            Aucune demande disponible pour votre filière.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>