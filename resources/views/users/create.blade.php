<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ajouter un Utilisateur - Lyon Palme</title>
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

    <main class="max-w-4xl mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Ajouter un Utilisateur</h1>
            <p class="text-gray-600">Créer un nouveau membre du club</p>
        </div>

        @if(session('error') || (isset($errors) && $errors->has('token')))
            <div class="alert alert-error mb-6">
                <strong>Erreur de sécurité :</strong> Votre session a expiré. Veuillez actualiser la page et réessayer.
                <button onclick="window.location.reload()" class="underline ml-2">Actualiser</button>
            </div>
        @endif

        @if($errors->any() && !$errors->has('token'))
            <div class="alert alert-error mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="form-label">Nom complet *</label>
                        <input type="text" id="name" name="name" class="form-input" 
                               value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="form-label">Adresse e-mail *</label>
                        <input type="email" id="email" name="email" class="form-input" 
                               value="{{ old('email') }}" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="form-label">Mot de passe *</label>
                        <input type="password" id="password" name="password" class="form-input" required>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
                    </div>

                    <div>
                        <label for="phone" class="form-label">Téléphone</label>
                        <input type="tel" id="phone" name="phone" class="form-input" 
                               value="{{ old('phone') }}">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="birth_date" class="form-label">Date de naissance</label>
                        <input type="date" id="birth_date" name="birth_date" class="form-input" 
                               value="{{ old('birth_date') }}">
                        @error('birth_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Sélection des rôles -->
                <div class="mt-6">
                    <label class="form-label">Rôles *</label>
                    <div class="grid grid-cols-2 gap-4 mt-2">
                        @foreach($roles as $role)
                            <div class="flex items-center">
                                <input type="checkbox" id="role_{{ $role->id }}" name="roles[]" value="{{ $role->id }}"
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                       @if(old('roles') && in_array($role->id, old('roles'))) checked @endif>
                                <label for="role_{{ $role->id }}" class="ml-2 text-sm text-gray-700 capitalize">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('roles')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="address" class="form-label">Adresse</label>
                    <textarea id="address" name="address" rows="3" class="form-input">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center mt-8">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Créer l'utilisateur
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
