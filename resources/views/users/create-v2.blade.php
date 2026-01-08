@extends('layouts.app-v2')

@section('title', 'Créer un utilisateur')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <!-- Breadcrumb -->
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <a href="{{ route('users.index') }}" style="color: var(--lp-teal); text-decoration: none;">Utilisateurs</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">Nouveau</span>
    </nav>

    <!-- En-tête -->
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
            Créer un nouvel utilisateur
        </h1>
        <p style="color: var(--lp-text-muted);">
            Créez un compte pour un nouveau membre du club avec son rôle et ses permissions
        </p>
    </div>

    <!-- Formulaire -->
    <div class="card">
        <form method="POST" action="{{ route('users.store') }}" style="padding: var(--lp-space-lg);">
            @csrf

            <!-- Informations personnelles -->
            <div style="margin-bottom: 2rem;">
                <h2 style="font-size: 1.25rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid var(--lp-border);">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: inline; vertical-align: middle; margin-right: 0.5rem;">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Informations personnelles
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Nom d'utilisateur -->
                    <div class="form-group">
                        <label for="name" class="form-label required">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Nom d'utilisateur
                        </label>
                        <input 
                            type="text" 
                            class="form-input @error('name') is-invalid @enderror" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            autofocus
                            placeholder="Ex: jean.dupont"
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small style="color: var(--lp-text-muted); font-size: 0.875rem; display: block; margin-top: 0.25rem;">
                            Utilisé pour la connexion et l'affichage
                        </small>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label required">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            Adresse email
                        </label>
                        <input 
                            type="email" 
                            class="form-input @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required
                            placeholder="jean.dupont@example.com"
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Prénom -->
                    <div class="form-group">
                        <label for="first_name" class="form-label">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Prénom
                        </label>
                        <input 
                            type="text" 
                            class="form-input @error('first_name') is-invalid @enderror" 
                            id="first_name" 
                            name="first_name" 
                            value="{{ old('first_name') }}"
                            placeholder="Jean"
                        >
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nom de famille -->
                    <div class="form-group">
                        <label for="last_name" class="form-label">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Nom de famille
                        </label>
                        <input 
                            type="text" 
                            class="form-input @error('last_name') is-invalid @enderror" 
                            id="last_name" 
                            name="last_name" 
                            value="{{ old('last_name') }}"
                            placeholder="Dupont"
                        >
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Rôle et permissions -->
            <div style="margin-bottom: 2rem;">
                <h2 style="font-size: 1.25rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid var(--lp-border);">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: inline; vertical-align: middle; margin-right: 0.5rem;">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    Rôle et permissions
                </h2>

                <div class="form-group">
                    <label for="role_id" class="form-label required">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        Rôle
                    </label>
                    <select 
                        class="form-select @error('role_id') is-invalid @enderror" 
                        id="role_id" 
                        name="role_id" 
                        required
                    >
                        <option value="">Sélectionnez un rôle</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $role->nom_role)) }}
                                @if($role->description)
                                    - {{ $role->description }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    <!-- Info sur les rôles -->
                    <div style="margin-top: 1rem; padding: 1rem; background: var(--lp-bg-ocean); border-left: 4px solid var(--lp-teal); border-radius: var(--lp-radius);">
                        <div style="font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                            💡 Permissions par rôle :
                        </div>
                        <ul style="margin: 0; padding-left: 1.5rem; color: var(--lp-text-muted); font-size: 0.9375rem;">
                            <li><strong>Président</strong> : Accès complet à toutes les fonctionnalités</li>
                            <li><strong>Responsable planning</strong> : Gestion des séances, entraînements et adhérents</li>
                            <li><strong>Entraîneur</strong> : Consultation et gestion de ses propres programmes</li>
                            <li><strong>Membre</strong> : Consultation uniquement (planning, profils)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Mot de passe -->
            <div style="margin-bottom: 2rem;">
                <h2 style="font-size: 1.25rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid var(--lp-border);">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: inline; vertical-align: middle; margin-right: 0.5rem;">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    Sécurité
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Mot de passe -->
                    <div class="form-group">
                        <label for="password" class="form-label required">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            Mot de passe
                        </label>
                        <input 
                            type="password" 
                            class="form-input @error('password') is-invalid @enderror" 
                            id="password" 
                            name="password" 
                            required
                            placeholder="••••••••"
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small style="color: var(--lp-text-muted); font-size: 0.875rem; display: block; margin-top: 0.25rem;">
                            Minimum 8 caractères
                        </small>
                    </div>

                    <!-- Confirmation mot de passe -->
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label required">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            Confirmer le mot de passe
                        </label>
                        <input 
                            type="password" 
                            class="form-input" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            required
                            placeholder="••••••••"
                        >
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div style="display: flex; gap: 1rem; justify-content: flex-end; padding-top: 1.5rem; border-top: 1px solid var(--lp-border);">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                    Annuler
                </a>
                <button type="submit" class="btn btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                        <polyline points="7 3 7 8 15 8"></polyline>
                    </svg>
                    Créer l'utilisateur
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
