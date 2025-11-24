<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inscription - Lyon Palme</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-2xl mx-auto px-4">
        <!-- Logo/En-tête -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-900 mb-2">Lyon Palme</h1>
            <p class="text-gray-600">Club de plongée sous-marine</p>
        </div>

        <!-- Messages d'erreur -->
        @if($errors->any())
            <div class="alert alert-error mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire d'inscription -->
        <div class="card">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-1">Inscription</h2>
                <p class="text-gray-600">Rejoignez notre club de plongée</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom complet -->
                    <div class="md:col-span-2">
                        <label for="name" class="form-label">Nom complet *</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               class="form-input @error('name') border-red-500 @enderror" 
                               value="{{ old('name') }}" 
                               required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="form-label">Adresse e-mail *</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               class="form-input @error('email') border-red-500 @enderror" 
                               value="{{ old('email') }}" 
                               required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label for="phone" class="form-label">Téléphone</label>
                        <input type="tel" 
                               id="phone" 
                               name="phone" 
                               class="form-input @error('phone') border-red-500 @enderror" 
                               value="{{ old('phone') }}">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date de naissance -->
                    <div>
                        <label for="birth_date" class="form-label">Date de naissance</label>
                        <input type="date" 
                               id="birth_date" 
                               name="birth_date" 
                               class="form-input @error('birth_date') border-red-500 @enderror" 
                               value="{{ old('birth_date') }}">
                        @error('birth_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <label for="password" class="form-label">Mot de passe *</label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-input @error('password') border-red-500 @enderror" 
                               required>
                        <p class="text-xs text-gray-500 mt-1">Minimum 8 caractères</p>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirmation mot de passe -->
                    <div>
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe *</label>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="form-input" 
                               required>
                    </div>
                </div>

                <!-- Adresse -->
                <div class="mt-6">
                    <label for="address" class="form-label">Adresse</label>
                    <textarea id="address" 
                              name="address" 
                              rows="3" 
                              class="form-input @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Information -->
                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm text-blue-800">
                        <strong>Information :</strong> En vous inscrivant, vous obtenez automatiquement le statut d'adhérent. 
                        Un responsable du club validera votre inscription et vous contactera pour finaliser votre adhésion.
                    </p>
                </div>

                <!-- Boutons -->
                <div class="flex flex-col sm:flex-row justify-between items-center mt-8 space-y-4 sm:space-y-0">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">
                        ← Déjà un compte ? Se connecter
                    </a>
                    <button type="submit" class="btn btn-primary">
                        S'inscrire
                    </button>
                </div>
            </form>
        </div>

        <!-- Informations supplémentaires -->
        <div class="mt-6 text-center text-sm text-gray-500">
            <p>En vous inscrivant, vous acceptez nos conditions d'utilisation.</p>
            <p>Pour toute question : contact@lyonpalme.fr</p>
        </div>
    </div>
</body>
</html>
