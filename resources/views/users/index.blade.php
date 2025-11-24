<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs - Lyon Palme</title>
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
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Utilisateurs</h1>
                <p class="text-gray-600">Gestion des membres du club</p>
            </div>
            
            <div class="flex items-center space-x-4">
                <a href="{{ route('users.create') }}" class="btn btn-primary">Nouvel Utilisateur</a>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Liste des utilisateurs -->
        @if($users->count() > 0)
            <div class="card">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Rôles</th>
                                <th>Téléphone</th>
                                <th>Inscription</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td>
                                        <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                        @if($user->date_naissance)
                                            <div class="text-sm text-gray-500">
                                                Né(e) le {{ $user->date_naissance->format('d/m/Y') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-sm text-gray-900">{{ $user->email }}</td>
                                    <td>
                                        @if($user->roles)
                                            @foreach($user->roles as $role)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-1">
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-gray-400">Aucun rôle</span>
                                        @endif
                                    </td>
                                    <td class="text-sm text-gray-900">{{ $user->phone ?: ($user->telephone ?: 'Non renseigné') }}</td>
                                    <td class="text-sm text-gray-900">{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('users.show', $user) }}" 
                                               class="text-blue-600 hover:text-blue-800 text-sm">Voir</a>
                                            <a href="{{ route('users.edit', $user) }}" 
                                               class="text-indigo-600 hover:text-indigo-800 text-sm">Modifier</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="card text-center py-12">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucun utilisateur</h3>
                <p class="text-gray-600 mb-6">Commencez par ajouter des membres</p>
                <a href="{{ route('users.create') }}" class="btn btn-primary">Ajouter un Utilisateur</a>
            </div>
        @endif
    </main>
</body>
</html>
