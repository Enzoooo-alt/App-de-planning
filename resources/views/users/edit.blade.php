<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur - Lyon Palme</title>
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
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Modifier l'Utilisateur</h1>
            <p class="text-gray-600">Modifiez les informations de {{ $user->name }}</p>
        </div>

        <div class="card">
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="form-label">Nom complet *</label>
                        <input type="text" id="name" name="name" class="form-input" 
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="form-label">Adresse e-mail *</label>
                        <input type="email" id="email" name="email" class="form-input" 
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="form-label">Téléphone</label>
                        <input type="tel" id="phone" name="phone" class="form-input" 
                               value="{{ old('phone', $user->phone) }}">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="birth_date" class="form-label">Date de naissance</label>
                        <input type="date" id="birth_date" name="birth_date" class="form-input" 
                               value="{{ old('birth_date', $user->birth_date?->format('Y-m-d')) }}">
                        @error('birth_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="address" class="form-label">Adresse</label>
                    <textarea id="address" name="address" rows="3" class="form-input">{{ old('address', $user->address) }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-md">
                    <h4 class="text-sm font-medium text-yellow-800 mb-2">Modification du mot de passe (optionnel)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="form-label">Nouveau mot de passe</label>
                            <input type="password" id="password" name="password" class="form-input">
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input">
                        </div>
                    </div>
                    <p class="text-xs text-yellow-700 mt-2">Laissez vide pour ne pas modifier le mot de passe</p>
                </div>

                <div class="flex justify-between items-center mt-8">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
