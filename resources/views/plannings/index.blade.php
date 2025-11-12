<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plannings - Lyon Palme</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}" class="text-xl font-bold">🏊‍♂️ Lyon Palme</a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('dashboard') }}" class="border-transparent text-blue-100 hover:border-gray-300 hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="{{ route('plannings.index') }}" class="border-indigo-500 text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Plannings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Plannings d'entraînement</h1>
                <a href="{{ route('plannings.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Nouveau planning
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                @if($plannings->count() > 0)
                    <ul class="divide-y divide-gray-200">
                        @foreach($plannings as $planning)
                            <li class="px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center">
                                            <div class="flex-1">
                                                <p class="text-lg font-semibold text-gray-900">
                                                    {{ $planning->day }} {{ $planning->date->format('d/m/Y') }}
                                                </p>
                                                <p class="text-sm text-gray-600">
                                                    {{ \Carbon\Carbon::parse($planning->start_time)->format('H:i') }} - 
                                                    {{ \Carbon\Carbon::parse($planning->end_time)->format('H:i') }}
                                                </p>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    Coach: {{ $planning->coach1 }}
                                                    @if($planning->coach2)
                                                        & {{ $planning->coach2 }}
                                                    @endif
                                                </p>
                                                @if($planning->description)
                                                    <p class="text-sm text-gray-600 mt-1">{{ $planning->description }}</p>
                                                @endif
                                                <div class="flex items-center mt-2">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                        @if($planning->isFull()) bg-red-100 text-red-800 @else bg-green-100 text-green-800 @endif">
                                                        {{ $planning->users->count() }} / {{ $planning->max_participants }} inscrits
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('plannings.show', $planning) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-3 rounded text-sm">
                                            Voir
                                        </a>
                                        <a href="{{ route('plannings.edit', $planning) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-3 rounded text-sm">
                                            Modifier
                                        </a>
                                        @if(!$planning->isFull())
                                            <form action="{{ route('plannings.register', $planning) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-3 rounded text-sm">
                                                    S'inscrire
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('plannings.destroy', $planning) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded text-sm">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-500 text-lg">Aucun planning disponible.</p>
                        <a href="{{ route('plannings.create') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Créer le premier planning
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </main>
</body>
</html>
