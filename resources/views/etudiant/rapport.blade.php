<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mon rapport de stage
        </h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded">{{ session('error') }}</div>
        @endif

        @if($rapport)
            <div class="bg-white rounded shadow p-6">
                <h3 class="font-semibold text-lg mb-4">Rapport déposé</h3>
                <p><span class="text-gray-500">Date de dépôt :</span>
                    {{ $rapport->date_depot->format('d/m/Y') }}</p>
                <a href="{{ Storage::url($rapport->fichier) }}"
                   target="_blank"
                   class="mt-3 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    📄 Télécharger mon rapport
                </a>
            </div>
        @else
            <div class="bg-white rounded shadow p-6">
                <h3 class="font-semibold text-lg mb-4">Déposer mon rapport de stage</h3>

                @if($convention)
                    <form method="POST" action="{{ route('etudiant.rapport.store') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="convention_id" value="{{ $convention->id }}">
                        <div class="mb-4">
                            <x-input-label for="fichier" value="Rapport (PDF)" />
                            <input type="file" id="fichier" name="fichier"
                                   accept=".pdf"
                                   class="block mt-1 w-full border border-gray-300 rounded p-2">
                            <x-input-error :messages="$errors->get('fichier')" class="mt-2" />
                        </div>
                        <x-primary-button>Déposer le rapport</x-primary-button>
                    </form>
                @else
                    <p class="text-gray-400">
                        Vous devez avoir une convention signée pour déposer un rapport.
                    </p>
                @endif
            </div>
        @endif

    </div>
</x-app-layout>