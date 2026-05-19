<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Entreprise</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white border-b px-6 py-4 flex justify-between items-center">
            <span class="font-bold text-lg">🏢 Espace Entreprise</span>
            <form method="POST" action="{{ route('entreprise.logout') }}">
                @csrf
                <button class="text-sm text-red-500">Déconnexion</button>
            </form>
        </nav>

        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold">
                    Bienvenue, {{ auth('entreprise')->user()->raison_sociale }}
                </h3>
                <p class="text-gray-500">Secteur : {{ auth('entreprise')->user()->secteur }}</p>
            </div>
        </div>
    </div>
</body>
</html>