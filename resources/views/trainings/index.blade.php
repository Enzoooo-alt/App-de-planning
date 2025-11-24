<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entraînements - Lyon Palme</title>
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

    <main class="max-w-7xl mx-auto px-4 py-8">
        <!-- En-tête -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Entraînements</h1>
                <p class="text-gray-600">Bibliothèque des exercices et séances d'entraînement</p>
            </div>
            
            <div class="flex items-center space-x-4">
                <a href="{{ route('trainings.create') }}" class="btn btn-primary">Nouvel Entraînement</a>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Liste des entraînements -->
        @if($trainings->count() > 0)
            <div class="card">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Type</th>
                                <th>Niveau</th>
                                <th>Durée</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($trainings as $training)
                                <tr class="hover:bg-gray-50">
                                    <td>
                                        <div class="font-medium text-gray-900">{{ $training->title }}</div>
                                        @if($training->description)
                                            <div class="text-sm text-gray-500">{{ Str::limit($training->description, 100) }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ ucfirst($training->type) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ ucfirst($training->niveau) }}
                                        </span>
                                    </td>
                                    <td class="text-sm text-gray-900">{{ $training->duree_minutes }} min</td>
                                    <td>
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('trainings.show', $training) }}" 
                                               class="text-blue-600 hover:text-blue-800 text-sm">Voir</a>
                                            <a href="{{ route('trainings.edit', $training) }}" 
                                               class="text-indigo-600 hover:text-indigo-800 text-sm">Modifier</a>
                                            @if($training->pdf_path)
                                                <a href="{{ route('trainings.download-pdf', $training) }}" 
                                                   class="text-green-600 hover:text-green-800 text-sm">PDF</a>
                                            @endif
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
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucun entraînement</h3>
                <p class="text-gray-600 mb-6">Commencez par créer votre premier entraînement</p>
                <a href="{{ route('trainings.create') }}" class="btn btn-primary">Créer un Entraînement</a>
            </div>
        @endif
    </main>
</body>
</html>
