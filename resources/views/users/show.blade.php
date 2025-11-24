<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur - Lyon Palme</title>
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
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $user->name }}</h1>
            <p class="text-gray-600">Profil utilisateur</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Informations principales -->
            <div class="lg:col-span-2">
                <div class="card">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Informations personnelles</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Nom complet</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $user->name }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Email</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $user->email }}</p>
                        </div>

                        @if($user->phone)
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Téléphone</h3>
                                <p class="mt-1 text-lg font-semibold text-gray-900">{{ $user->phone }}</p>
                            </div>
                        @endif

                        @if($user->birth_date)
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Date de naissance</h3>
                                <p class="mt-1 text-lg font-semibold text-gray-900">{{ $user->birth_date->format('d/m/Y') }}</p>
                            </div>
                        @endif

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Membre depuis</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $user->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>

                    @if($user->address)
                        <div class="mt-6 pt-6 border-t">
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Adresse</h3>
                            <p class="text-gray-700">{{ $user->address }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Statistiques et activités -->
            <div>
                <div class="card">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Activités</h2>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                            <span class="text-sm font-medium text-green-700">Plannings</span>
                            <span class="text-lg font-bold text-green-900">{{ $user->plannings->count() }}</span>
                        </div>

                        @if($user->roles->count() > 0)
                            <div class="pt-4 border-t">
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Rôles</h4>
                                <div class="space-y-1">
                                    @foreach($user->roles as $role)
                                        <span class="inline-block px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-700 rounded-full">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>



        <div class="flex justify-between items-center mt-8">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                Retour à la liste
            </a>
            <div class="space-x-3">
                <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">
                    Modifier
                </a>
                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
