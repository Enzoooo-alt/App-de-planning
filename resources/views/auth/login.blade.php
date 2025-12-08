@extends('layouts.app')

@section('title', 'Connexion - Lyon Palme')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <!-- Logo -->
        <div class="auth-header">
            <h1 class="auth-logo">Lyon Palme</h1>
            <p class="auth-subtitle">Connexion à votre espace</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="status-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-input-enhanced" 
                       type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                    <div class="form-error-enhanced">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group spaced">
                <label for="password" class="form-label">Mot de passe</label>
                <input id="password" class="form-input-enhanced"
                       type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <div class="form-error-enhanced">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="checkbox-group">
                <label for="remember_me" class="checkbox-label">
                    <input id="remember_me" type="checkbox" class="checkbox-input" name="remember">
                    <span class="checkbox-text">Se souvenir de moi</span>
                </label>
            </div>

            <div class="form-actions">
                @if (Route::has('password.request'))
                    <a class="link-forgot" 
                       href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif

                <button type="submit" class="btn-submit">
                    Se connecter
                </button>
            </div>

            <!-- Register Link -->
            <div class="auth-footer">
                <p class="auth-footer-text">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="auth-footer-link">
                        Créer un compte
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
