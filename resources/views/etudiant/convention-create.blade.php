<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer une convention de stage
        </h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded shadow p-6">

            @if($errors->any())
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('etudiant.convention.store') }}">
                @csrf

                {{-- Type de convention --}}
                <div class="mb-4">
                    <x-input-label for="type" value="Type de convention" />
                    <select id="type" name="type"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Choisir --</option>
                        <option value="stage_classique" {{ old('type') == 'stage_classique' ? 'selected' : '' }}>
                            TYPE 1 — Stage classique
                        </option>
                        <option value="pfe" {{ old('type') == 'pfe' ? 'selected' : '' }}>
                            TYPE 2 — PFE (Projet de Fin d'Études)
                        </option>
                    </select>
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                </div>

                {{-- Entreprise --}}
                <div class="mb-4">
                    <x-input-label for="entreprise_id" value="Entreprise d'accueil" />
                    <select id="entreprise_id" name="entreprise_id"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Choisir l'entreprise --</option>
                        @foreach($entreprises as $ent)
                            <option value="{{ $ent->id }}"
                                {{ old('entreprise_id') == $ent->id ? 'selected' : '' }}>
                                {{ $ent->raison_sociale }} — {{ $ent->secteur }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('entreprise_id')" class="mt-2" />
                </div>

                {{-- Intitulé --}}
                <div class="mb-4">
                    <x-input-label for="intitule_stage" value="Intitulé du stage" />
                    <x-text-input id="intitule_stage" name="intitule_stage" type="text"
                        class="block mt-1 w-full" :value="old('intitule_stage')" required />
                    <x-input-error :messages="$errors->get('intitule_stage')" class="mt-2" />
                </div>

                {{-- Dates --}}
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <x-input-label for="date_debut" value="Date de début" />
                        <x-text-input id="date_debut" name="date_debut" type="date"
                            class="block mt-1 w-full" :value="old('date_debut')" required />
                        <x-input-error :messages="$errors->get('date_debut')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="date_fin" value="Date de fin" />
                        <x-text-input id="date_fin" name="date_fin" type="date"
                            class="block mt-1 w-full" :value="old('date_fin')" required />
                        <x-input-error :messages="$errors->get('date_fin')" class="mt-2" />
                    </div>
                </div>

                {{-- Service --}}
                <div class="mb-4">
                    <x-input-label for="service" value="Service / Département (optionnel)" />
                    <x-text-input id="service" name="service" type="text"
                        class="block mt-1 w-full" :value="old('service')" />
                </div>

                {{-- Maître de stage --}}
                <div class="mb-4">
                    <x-input-label for="maitre_stage" value="Maître de stage (optionnel)" />
                    <x-text-input id="maitre_stage" name="maitre_stage" type="text"
                        class="block mt-1 w-full" :value="old('maitre_stage')" />
                </div>

                <div class="flex gap-3">
                    <x-primary-button>Créer la convention</x-primary-button>
                    <a href="{{ route('etudiant.convention') }}"
                       class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>