<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter une entreprise
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

            <form method="POST" action="{{ route('doyen.entreprises.store') }}">
                @csrf
                <div class="mb-4">
                    <x-input-label for="raison_sociale" value="Raison sociale" />
                    <x-text-input id="raison_sociale" name="raison_sociale" type="text"
                        class="block mt-1 w-full" :value="old('raison_sociale')" required />
                </div>
                <div class="mb-4">
                    <x-input-label for="adresse" value="Adresse" />
                    <x-text-input id="adresse" name="adresse" type="text"
                        class="block mt-1 w-full" :value="old('adresse')" required />
                </div>
                <div class="mb-4">
                    <x-input-label for="secteur" value="Secteur d'activité" />
                    <x-text-input id="secteur" name="secteur" type="text"
                        class="block mt-1 w-full" :value="old('secteur')" />
                </div>
                <div class="mb-4">
                    <x-input-label for="email_contact" value="Email de contact" />
                    <x-text-input id="email_contact" name="email_contact" type="email"
                        class="block mt-1 w-full" :value="old('email_contact')" required />
                </div>
                <div class="mb-4">
                    <x-input-label for="password" value="Mot de passe" />
                    <x-text-input id="password" name="password" type="password"
                        class="block mt-1 w-full" required />
                </div>
                <div class="mb-4">
                    <x-input-label for="password_confirmation" value="Confirmer le mot de passe" />
                    <x-text-input id="password_confirmation" name="password_confirmation"
                        type="password" class="block mt-1 w-full" required />
                </div>
                <div class="flex gap-3">
                    <x-primary-button>Créer l'entreprise</x-primary-button>
                    <a href="{{ route('doyen.utilisateurs') }}"
                       class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>