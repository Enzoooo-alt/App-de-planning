<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription - Lyon Palme</title>
    @vite(['resources/css/lyon-palme.css'])
    <style>
        body {
            background: var(--gradient-ocean);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .auth-container {
            max-width: 28rem;
            width: 100%;
        }
        .auth-card {
            background: var(--bg-primary);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-ocean);
            padding: 2rem;
            border: 1px solid rgba(13, 148, 136, 0.1);
        }
        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .auth-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--brand-teal);
            margin-bottom: 0.5rem;
        }
        .auth-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            margin-bottom: 2rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--border);
            border-radius: var(--radius);
            font-size: 1rem;
            transition: var(--transition-wave);
        }
        .form-input:focus {
            outline: none;
            border-color: var(--brand-teal);
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
        }
        .form-error {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: var(--danger);
        }
        .legal-links {
            margin-top: 1.5rem;
            padding: 1rem;
            background: var(--bg-ocean);
            border-radius: var(--radius);
            border-left: 3px solid var(--brand-teal);
        }
        .legal-text {
            font-size: 0.875rem;
            color: var(--text-muted);
            line-height: 1.5;
        }
        .legal-link {
            color: var(--brand-teal);
            text-decoration: none;
            font-weight: 500;
        }
        .legal-link:hover {
            text-decoration: underline;
        }
        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
        }
        .back-link {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-size: 0.875rem;
            transition: var(--transition-fast);
        }
        .back-link:hover {
            color: white;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- En-tête -->
        <div class="auth-header">
            <a href="/" class="inline-block">
                <h1 class="auth-title">🏊 Lyon Palme</h1>
            </a>
            <p class="auth-subtitle">Rejoignez notre communauté nautique</p>
        </div>

        <!-- Carte d'inscription -->
        <div class="auth-card">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nom -->
                <div class="form-group">
                    <label for="name" class="form-label">Nom complet</label>
                    <input id="name" 
                           type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus 
                           autocomplete="name"
                           class="form-input">
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">Adresse email</label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="username"
                           class="form-input">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mot de passe -->
                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="new-password"
                           class="form-input">
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmer le mot de passe -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                    <input id="password_confirmation" 
                           type="password" 
                           name="password_confirmation" 
                           required 
                           autocomplete="new-password"
                           class="form-input">
                    @error('password_confirmation')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Information sur le rôle -->
                <div class="form-group">
                    <div style="padding: 1rem; background: var(--bg-ocean); border-radius: var(--radius); border-left: 3px solid var(--brand-teal);">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 1.25rem;">ℹ️</span>
                            <div>
                                <p style="font-size: 0.875rem; font-weight: 600; color: var(--brand-teal); margin: 0;">Rôle par défaut : Membre</p>
                                <p style="font-size: 0.75rem; color: var(--text-muted); margin: 0;">Vous serez automatiquement enregistré comme membre du club</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acceptation des conditions -->
                <div class="legal-links">
                    <div class="legal-text">
                        <p style="margin-bottom: 0.75rem;">En vous inscrivant, vous acceptez :</p>
                        <ul style="margin: 0; padding-left: 1.25rem; line-height: 1.8;">
                            <li>Nos <a href="{{ route('privacy') }}" target="_blank" class="legal-link">conditions d'utilisation et politique de confidentialité</a></li>
                            <li>Le <a href="{{ route('reglement') }}" target="_blank" class="legal-link">règlement intérieur</a> du club</li>
                        </ul>
                    </div>
                </div>

                <!-- Bouton d'inscription -->
                <button type="submit" 
                        class="button button-primary" 
                        style="width: 100%; margin-top: 1.5rem; padding: 0.875rem; font-size: 1rem;">
                    🏊 Rejoindre Lyon Palme
                </button>
            </form>

            <!-- Lien de connexion -->
            <div style="margin-top: 1.5rem; text-align: center;">
                <p style="font-size: 0.875rem; color: var(--text-muted); margin: 0;">
                    Déjà membre ?
                    <a href="{{ route('login') }}" 
                       class="legal-link">
                        Se connecter
                    </a>
                </p>
            </div>
            </form>
        </div>

        <!-- Retour à l'accueil -->
        <div class="auth-footer">
            <a href="{{ route('welcome') }}" class="back-link">
                ← Retour à l'accueil
            </a>
        </div>
    </div>
</body>
</html>
