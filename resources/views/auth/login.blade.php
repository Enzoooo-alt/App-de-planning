<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion - Lyon Palme</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full">
        <!-- Logo/En-tête -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-900 mb-2">Lyon Palme</h1>
            <p class="text-gray-600">Club de plongée sous-marine</p>
        </div>

        <!-- Messages de succès/erreur -->
        @if(session('success'))
            <div class="alert alert-success mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Formulaire de connexion -->
        <div class="card">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-1">Connexion</h2>
                <p class="text-gray-600">Accédez à votre espace membre</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-input @error('email') border-red-500 @enderror" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-input @error('password') border-red-500 @enderror" 
                           required>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Se souvenir de moi</span>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-full">
                    Se connecter
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Pas encore de compte ? 
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        S'inscrire
                    </a>
                </p>
            </div>
        </div>

        <!-- Informations de test -->
        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <p class="text-sm text-blue-800 font-medium mb-2">Comptes de test disponibles :</p>
            <div class="text-xs text-blue-700 space-y-1">
                <div>Email: test@test.com | Mot de passe: password</div>
                <div>Email: admin@lyonpalme.fr | Mot de passe: password</div>
            </div>
        </div>

        <!-- Informations supplémentaires -->
        <div class="mt-4 text-center text-sm text-gray-500">
            <p>Pour toute question, contactez-nous à :</p>
            <p>contact@lyonpalme.fr</p>
        </div>
    </div>
</body>
</html>