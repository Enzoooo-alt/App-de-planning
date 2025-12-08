@extends('layouts.app')

@section('title', 'Inscription - Lyon Palme')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <!-- Logo -->
        <div class="auth-header">
            <h1 class="auth-logo">Lyon Palme</h1>
            <p class="auth-subtitle">Créer votre compte</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">Nom complet</label>
                <input id="name" class="form-input-enhanced" 
                       type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                    <div class="form-error-enhanced">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="form-group spaced">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-input-enhanced" 
                       type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                @error('email')
                    <div class="form-error-enhanced">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group spaced">
                <label for="password" class="form-label">Mot de passe</label>
                <input id="password" class="form-input-enhanced"
                       type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <div class="form-error-enhanced">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group spaced">
                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                <input id="password_confirmation" class="form-input-enhanced"
                       type="password" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                    <div class="form-error-enhanced">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <a class="link-forgot" 
                   href="{{ route('login') }}">
                    Déjà inscrit ?
                </a>

                <button type="submit" class="btn-submit">
                    S'inscrire
                </button>
            </div>

            <!-- Information -->
           <!-- Juste cette partie modifiée -->
        <div class="auth-footer">
            <p class="info-disclaimer">
                <a href="{{ route('privacy') }}" target="_blank" 
                style="color: #3498db; text-decoration: underline; font-weight: 500;">
                    En vous inscrivant, vous acceptez nos conditions d'utilisation et notre politique de confidentialité.
                </a><br>
            </p>
        </div>

        <div class="auth-footer">
            <p class="info-disclaimer">
                <a href="{{ route ('reglement') }}" target="_blank" 
                style="color: #3498db; text-decoration: underline; font-weight: 500;">
                Reglement intérieur
                </a>
            </p>
        </div>

        
        <div class="auth-footer">
            <p class="info-disclaimer">
                <a href="{{ route ('welcome') }}" class="btn-back">
                Retour a la page d'accueil 
                </a>
            </p>
        </div>

        </form>
    </div>
</div>
@endsection



<style>

.btn-back {
    background: #3498db;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

</style>
