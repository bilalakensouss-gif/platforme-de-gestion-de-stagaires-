<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter un encadrant
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

            <form method="POST" action="{{ route('doyen.encadrants.store') }}">
                @csrf
                <div class="mb-4">
                    <x-input-label for="nom" value="Nom" />
                    <x-text-input id="nom" name="nom" type="text"
                        class="block mt-1 w-full" :value="old('nom')" required />
                </div>
                <div class="mb-4">
                    <x-input-label for="prenom" value="Prénom" />
                    <x-text-input id="prenom" name="prenom" type="text"
                        class="block mt-1 w-full" :value="old('prenom')" required />
                </div>
                <div class="mb-4">
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" name="email" type="email"
                        class="block mt-1 w-full" :value="old('email')" required />
                </div>
                <div class="mb-4">
                    <x-input-label for="specialite" value="Spécialité" />
                    <x-text-input id="specialite" name="specialite" type="text"
                        class="block mt-1 w-full" :value="old('specialite')" required />
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
                    <x-primary-button>Créer l'encadrant</x-primary-button>
                    <a href="{{ route('doyen.utilisateurs') }}"
                       class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>