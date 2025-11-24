<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $dashboardData['title'] ?? 'Dashboard' }} - Lyon Palme</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-blue-700 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/logo-lyon-palme.svg') }}" alt="Lyon Palme" class="h-10 w-10 mr-2">
                <h1 class="text-xl font-bold text-white">Lyon Palme</h1>
            </div>
            
            <div class="flex items-center space-x-6">
                @if($user->hasRole('admin') || $user->hasRole('responsable') || $user->hasRole('coach'))
                    <a href="{{ route('plannings.index') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md text-sm font-medium">Plannings</a>
                    <a href="{{ route('trainings.index') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md text-sm font-medium">Entraînements</a>
                @endif
                @if($user->hasRole('admin') || $user->hasRole('responsable'))
                    <a href="{{ route('users.index') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md text-sm font-medium">Utilisateurs</a>
                @endif
                @if($user->hasRole('adhérent'))
                    <a href="{{ route('plannings.index') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md text-sm font-medium">Mes Séances</a>
                    <a href="{{ route('trainings.index') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md text-sm font-medium">Exercices</a>
                @endif
                
                <!-- Profil utilisateur -->
                <div class="relative flex items-center space-x-4 ml-6 pl-6 border-l border-blue-500">
                    <div class="text-right">
                        <div class="text-white font-medium">{{ $user->name }}</div>
                        <div class="text-blue-200 text-xs">
                            {{ $user->roles->pluck('name')->map(function($role) { return ucfirst($role); })->join(', ') }}
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white px-4 py-2 rounded-md text-sm">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8">
        <!-- En-tête personnalisé -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $dashboardData['title'] }}</h1>
            <p class="text-gray-600">
                @if($user->hasRole('admin'))
                    Panneau d'administration du club Lyon Palme
                @elseif($user->hasRole('responsable'))
                    Gestion des activités et planifications
                @elseif($user->hasRole('coach'))
                    Création et gestion des entraînements
                @else
                    Bienvenue dans votre espace membre
                @endif
            </p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="text-3xl">👥</div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    @if($user->hasRole('admin')) Utilisateurs @else Membres @endif
                                </dt>
                                <dd class="text-3xl font-bold text-blue-600">{{ $stats['users_count'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="text-3xl">📅</div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Plannings</dt>
                                <dd class="text-3xl font-bold text-green-600">{{ $stats['plannings_count'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="text-3xl">🏊</div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Entraînements</dt>
                                <dd class="text-3xl font-bold text-purple-600">{{ $stats['trainings_count'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides personnalisées par rôle -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($dashboardData['actions'] as $action)
            <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="text-2xl mr-3">{{ $action['icon'] }}</div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $action['title'] }}</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">{{ $action['description'] }}</p>
                    <a href="{{ isset($action['params']) ? route($action['route'], $action['params']) : route($action['route']) }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 w-full justify-center">
                        Accéder
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Contenu spécifique par rôle -->
        @if($user->hasRole('admin'))
            @include('dashboard.admin', ['dashboardData' => $dashboardData])
        @elseif($user->hasRole('responsable'))
            @include('dashboard.responsable', ['dashboardData' => $dashboardData])
        @elseif($user->hasRole('coach'))
            @include('dashboard.coach', ['dashboardData' => $dashboardData])
        @else
            @include('dashboard.adherent', ['dashboardData' => $dashboardData])
        @endif
    </main>
</body>
</html>
