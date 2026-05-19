<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Espace Doyen
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3>Bienvenue, {{ auth()->user()->prenom }} {{ auth()->user()->nom }}</h3>
                <p class="text-gray-500">Rôle : Doyen</p>
            </div>
        </div>
    </div>
</x-app-layout>