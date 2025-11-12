<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Lyon Palme') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-xl font-bold">🏊‍♂️ Lyon Palme</h1>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('dashboard') }}" class="border-indigo-500 text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="{{ route('plannings.index') }}" class="border-transparent text-blue-100 hover:border-gray-300 hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Plannings
                        </a>
                        <a href="{{ route('users.index') }}" class="border-transparent text-blue-100 hover:border-gray-300 hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Adhérents
                        </a>
                        <a href="{{ route('trainings.index') }}" class="border-transparent text-blue-100 hover:border-gray-300 hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Entraînements
                        </a>
                        <a href="{{ route('materials.index') }}" class="border-transparent text-blue-100 hover:border-gray-300 hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Matériel
                        </a>
                        <a href="{{ route('competitions.index') }}" class="border-transparent text-blue-100 hover:border-gray-300 hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Compétitions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Bienvenue sur Lyon Palme</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card Plannings -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">📅</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Plannings d'entraînement
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        Gérer les créneaux
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="{{ route('plannings.index') }}" class="font-medium text-blue-700 hover:text-blue-900">
                                Voir les plannings
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Adhérents -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">👥</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Adhérents
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ \App\Models\User::count() }} membres
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="{{ route('users.index') }}" class="font-medium text-blue-700 hover:text-blue-900">
                                Gérer les adhérents
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Entraînements -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">📚</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Entraînements PDF
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        Ressources d'entraînement
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="{{ route('trainings.index') }}" class="font-medium text-blue-700 hover:text-blue-900">
                                Voir les entraînements
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Matériel -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">🏊‍♀️</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Matériel
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        Stock et emprunts
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="{{ route('materials.index') }}" class="font-medium text-blue-700 hover:text-blue-900">
                                Gérer le matériel
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Compétitions -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">🏆</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Compétitions
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        Événements et sorties
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="{{ route('competitions.index') }}" class="font-medium text-blue-700 hover:text-blue-900">
                                Voir les compétitions
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Statistiques -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">📊</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Statistiques
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        Vue d'ensemble du club
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <span class="font-medium text-gray-500">
                                Bientôt disponible
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
