<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning {{ $planning->date->format('d/m/Y') }} - Lyon Palme</title>
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
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">
                    Planning du {{ $planning->day }} {{ $planning->date->format('d/m/Y') }}
                </h1>
                <a href="{{ route('plannings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Retour aux plannings
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

            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Informations du créneau</h3>
                            <div class="mt-2 max-w-xl text-sm text-gray-500">
                                <p><strong>Date:</strong> {{ $planning->day }} {{ $planning->date->format('d/m/Y') }}</p>
                                <p><strong>Horaires:</strong> {{ \Carbon\Carbon::parse($planning->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($planning->end_time)->format('H:i') }}</p>
                                <p><strong>Coach principal:</strong> {{ $planning->coach1 }}</p>
                                @if($planning->coach2)
                                    <p><strong>Coach assistant:</strong> {{ $planning->coach2 }}</p>
                                @endif
                                <p><strong>Capacité:</strong> {{ $planning->users->count() }} / {{ $planning->max_participants }} participants</p>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Actions</h3>
                            <div class="mt-2 flex flex-col space-y-3">
                                @if(!$planning->users()->where('user_id', 1)->exists() && !$planning->isFull())
                                    <form action="{{ route('plannings.register', $planning) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            S'inscrire à ce créneau
                                        </button>
                                    </form>
                                @elseif($planning->users()->where('user_id', 1)->exists())
                                    <form action="{{ route('plannings.unregister', $planning) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Se désinscrire
                                        </button>
                                    </form>
                                @else
                                    <div class="w-full bg-gray-300 text-gray-500 font-bold py-2 px-4 rounded text-center">
                                        Créneau complet
                                    </div>
                                @endif
                                
                                <a href="{{ route('plannings.edit', $planning) }}" class="w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded text-center">
                                    Modifier ce planning
                                </a>
                            </div>
                        </div>
                    </div>

                    @if($planning->description)
                        <div class="mt-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Description de l'entraînement</h3>
                            <div class="mt-2 text-sm text-gray-500">
                                <p>{{ $planning->description }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Liste des participants inscrits -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                        Participants inscrits ({{ $planning->users->count() }})
                    </h3>
                    
                    @if($planning->users->count() > 0)
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($planning->users as $user)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center">
                                                <span class="text-sm font-medium text-white">
                                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                            @if($user->pivot->registration_date)
                                                <div class="text-xs text-gray-400">
                                                    Inscrit le {{ \Carbon\Carbon::parse($user->pivot->registration_date)->format('d/m/Y') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6">
                            <p class="text-gray-500">Aucun participant inscrit pour le moment.</p>
                        </div>
                    @endif

                    @if($planning->availableSpots() > 0)
                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-600">
                                {{ $planning->availableSpots() }} place(s) encore disponible(s)
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</body>
</html>
