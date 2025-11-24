<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plannings - Lyon Palme</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="navbar">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold hover:text-blue-200">Lyon Palme</a>
            </div>
            
            <div class="flex items-center space-x-4">
                <a href="{{ route('plannings.index') }}" class="hover:text-blue-200">Plannings</a>
                <a href="{{ route('trainings.index') }}" class="hover:text-blue-200">Entraînements</a>
                <a href="{{ route('users.index') }}" class="hover:text-blue-200">Utilisateurs</a>
                <div class="flex items-center space-x-4 ml-6">
                    <span class="text-blue-200">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-blue-200 hover:text-white">Déconnexion</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8">
        <!-- En-tête -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Plannings</h1>
                <p class="text-gray-600">Séances d'entraînement programmées</p>
            </div>
            
            <div class="flex items-center space-x-4">
                <a href="{{ route('plannings.create') }}" class="btn btn-primary">Nouveau Planning</a>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Liste des plannings -->
        @if($plannings->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($plannings as $planning)
                    <div class="card">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $planning->title }}</h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ ucfirst($planning->type) }}
                            </span>
                        </div>
                        
                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                            <div>📅 {{ $planning->date ? $planning->date->format('d/m/Y') : 'Date non définie' }}</div>
                            <div>🕐 {{ $planning->start_time ? $planning->start_time->format('H:i') : '--:--' }} - {{ $planning->end_time ? $planning->end_time->format('H:i') : '--:--' }}</div>
                            <div>👨‍🏫 Coach: {{ $planning->coach1 }}{{ $planning->coach2 ? ' & ' . $planning->coach2 : '' }}</div>
                            <div>👥 {{ $planning->users->count() }} participant(s)</div>
                        </div>

                        @if($planning->description)
                            <p class="text-sm text-gray-600 mb-4">{{ Str::limit($planning->description, 100) }}</p>
                        @endif
                        
                        <div class="flex items-center justify-between">
                            <div class="flex space-x-2">
                                <a href="{{ route('plannings.show', $planning) }}" class="text-blue-600 hover:text-blue-800 text-sm">Voir</a>
                                <a href="{{ route('plannings.edit', $planning) }}" class="text-indigo-600 hover:text-indigo-800 text-sm">Modifier</a>
                            </div>
                            
                            @if($planning->date && $planning->date >= now()->format('Y-m-d'))
                                <span class="text-green-600 text-xs font-medium">À venir</span>
                            @elseif($planning->date)
                                <span class="text-gray-400 text-xs font-medium">Passé</span>
                            @else
                                <span class="text-yellow-600 text-xs font-medium">Date manquante</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card text-center py-12">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucun planning</h3>
                <p class="text-gray-600 mb-6">Commencez par créer votre premier planning</p>
                <a href="{{ route('plannings.create') }}" class="btn btn-primary">Créer un Planning</a>
            </div>
        @endif
    </main>
</body>
</html>
