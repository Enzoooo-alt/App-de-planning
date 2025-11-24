<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Entraînement - Lyon Palme</title>
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

    <main class="max-w-2xl mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Créer un Entraînement</h1>
            <p class="text-gray-600">Ajoutez un nouvel exercice à la bibliothèque</p>
        </div>

        @if($errors->any())
            <div class="alert alert-error">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <form action="{{ route('trainings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    <!-- Titre -->
                    <div>
                        <label for="title" class="form-label">Titre de l'entraînement</label>
                        <input type="text" id="title" name="title" class="form-input" 
                               value="{{ old('title') }}" required>
                    </div>

                    <!-- Type et Niveau -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="type" class="form-label">Type</label>
                            <select id="type" name="type" class="form-input" required>
                                <option value="">Sélectionner</option>
                                <option value="technique" {{ old('type') === 'technique' ? 'selected' : '' }}>Technique</option>
                                <option value="endurance" {{ old('type') === 'endurance' ? 'selected' : '' }}>Endurance</option>
                                <option value="vitesse" {{ old('type') === 'vitesse' ? 'selected' : '' }}>Vitesse</option>
                                <option value="competition" {{ old('type') === 'competition' ? 'selected' : '' }}>Compétition</option>
                            </select>
                        </div>

                        <div>
                            <label for="niveau" class="form-label">Niveau</label>
                            <select id="niveau" name="niveau" class="form-input" required>
                                <option value="">Sélectionner</option>
                                <option value="debutant" {{ old('niveau') === 'debutant' ? 'selected' : '' }}>Débutant</option>
                                <option value="intermediaire" {{ old('niveau') === 'intermediaire' ? 'selected' : '' }}>Intermédiaire</option>
                                <option value="avance" {{ old('niveau') === 'avance' ? 'selected' : '' }}>Avancé</option>
                                <option value="competition" {{ old('niveau') === 'competition' ? 'selected' : '' }}>Compétition</option>
                            </select>
                        </div>
                    </div>

                    <!-- Durée -->
                    <div>
                        <label for="duree_minutes" class="form-label">Durée (minutes)</label>
                        <input type="number" id="duree_minutes" name="duree_minutes" class="form-input" 
                               value="{{ old('duree_minutes') }}" min="15" max="300" required>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" rows="6" class="form-input">{{ old('description') }}</textarea>
                    </div>

                    <!-- Fichier PDF -->
                    <div>
                        <label for="pdf_file" class="form-label">Fichier PDF (optionnel)</label>
                        <input type="file" id="pdf_file" name="pdf_file" class="form-input" accept=".pdf">
                        <p class="text-sm text-gray-600 mt-1">Taille maximale: 10 MB</p>
                    </div>

                    <!-- Plannings associés -->
                    @if($plannings->count() > 0)
                        <div>
                            <label class="form-label">Plannings associés (optionnel)</label>
                            <div class="space-y-2 max-h-40 overflow-y-auto">
                                @foreach($plannings as $planning)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="planning_ids[]" value="{{ $planning->id }}" 
                                               class="rounded border-gray-300 mr-2"
                                               {{ in_array($planning->id, old('planning_ids', [])) ? 'checked' : '' }}>
                                        <span class="text-sm">{{ $planning->title }} - {{ $planning->date->format('d/m/Y') }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Boutons -->
                    <div class="flex items-center space-x-4 pt-4">
                        <button type="submit" class="btn btn-primary">Créer l'Entraînement</button>
                        <a href="{{ route('trainings.index') }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
