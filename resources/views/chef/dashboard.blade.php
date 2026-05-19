<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tableau de bord — Chef de Filière
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-3xl font-bold text-blue-600">{{ $stats['etudiants'] }}</div>
                    <div class="text-gray-500">Étudiants de ma filière</div>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-3xl font-bold text-green-600">{{ $stats['conventions'] }}</div>
                    <div class="text-gray-500">Conventions</div>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-3xl font-bold text-orange-600">{{ $stats['a_signer'] }}</div>
                    <div class="text-gray-500">À signer</div>
                </div>
            </div>

            <div class="bg-white rounded shadow p-6">
                <h3 class="font-semibold text-lg mb-4">Actions rapides</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('chef.demandes') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        📄 Demandes de stage
                    </a>
                    <a href="{{ route('chef.conventions') }}"
                       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        📋 Conventions
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>