<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nom -->
        <div>
            <x-input-label for="nom" :value="__('Nom')" />
            <x-text-input id="nom"
                class="block mt-1 w-full"
                type="text"
                name="nom"
                :value="old('nom')"
                required autofocus />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <!-- Prénom -->
        <div class="mt-4">
            <x-input-label for="prenom" :value="__('Prénom')" />
            <x-text-input id="prenom"
                class="block mt-1 w-full"
                type="text"
                name="prenom"
                :value="old('prenom')"
                required />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>

        <!-- Filière -->
        <div class="mt-4">
            <x-input-label for="filiere" :value="__('Filière')" />
            <select id="filiere" name="filiere"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500
                       focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">-- Choisir votre filière --</option>
                <option value="Génie Informatique" {{ old('filiere') == 'Génie Informatique' ? 'selected' : '' }}>
                    Génie Informatique
                </option>
                <option value="Génie Électrique" {{ old('filiere') == 'Génie Électrique' ? 'selected' : '' }}>
                    Génie Électrique
                </option>
                <option value="Génie Civil" {{ old('filiere') == 'Génie Civil' ? 'selected' : '' }}>
                    Génie Civil
                </option>
                <option value="Génie Mécanique" {{ old('filiere') == 'Génie Mécanique' ? 'selected' : '' }}>
                    Génie Mécanique
                </option>
            </select>
            <x-input-error :messages="$errors->get('filiere')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Mot de passe -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmation mot de passe -->
        <div class="mt-4">
            <x-input-label for="password_confirmation"
                :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900"
               href="{{ route('login') }}">
                {{ __('Déjà inscrit ?') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __("S'inscrire") }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>