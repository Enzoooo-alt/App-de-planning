{{-- 
    Profil Utilisateur - Lyon Palme
    Vue pour la gestion et modification du profil utilisateur
    Design: Thème violet professionnel
--}}
@extends('layouts.app')

@section('title', 'Mon Profil - Lyon Palme')

@section('content')
<section style="padding: 2rem 0;">
    <div class="container">
        
        {{-- En-tête de la page profil --}}
        <div class="profile-section mb-6">
            <div class="profile-header">
                <h1 class="h1" style="display: flex; align-items: center; margin: 0;">
                    <span style="margin-right: 0.75rem; font-size: 2rem;">👤</span>
                    Mon Profil
                </h1>
                <p style="margin: 0.5rem 0 0; opacity: 0.95; font-size: 1.1rem;">
                    Gérez vos informations personnelles et paramètres de sécurité
                </p>
            </div>
        </div>

        {{-- Messages de feedback utilisateur --}}
        @if (session('success'))
            <div class="alert alert-success" style="margin-bottom: 1.5rem; background: var(--success-light); border: 2px solid var(--success); color: var(--success); padding: 1rem 1.25rem; border-radius: var(--radius); display: flex; align-items: center; font-weight: 500;">
                <span style="margin-right: 0.5rem; font-size: 1.1rem;">✅</span>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error" style="margin-bottom: 1.5rem; background: var(--danger-light); border: 2px solid var(--danger); color: var(--danger); padding: 1rem 1.25rem; border-radius: var(--radius);">
                <div style="display: flex; align-items: center; margin-bottom: 0.5rem;">
                    <span style="margin-right: 0.5rem; font-size: 1.1rem;">❌</span>
                    <span style="font-weight: 600;">Erreurs de validation :</span>
                </div>
                <ul style="margin: 0; padding-left: 1.25rem; list-style-type: disc;">
                    @foreach ($errors->all() as $error)
                        <li style="margin: 0.25rem 0;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Grille principale du profil --}}
        <div class="grid lg:grid-cols-3" style="gap: 2rem;">
            
            {{-- Section: Informations personnelles --}}
            <div style="grid-column: span 2;">
                <div class="profile-section">
                    <div class="profile-header">
                        <h2 class="h3" style="display: flex; align-items: center; margin: 0;">
                            <span style="margin-right: 0.5rem; font-size: 1.25rem;">✏️</span>
                            Informations personnelles
                        </h2>
                        <p style="margin: 0.5rem 0 0; opacity: 0.9; font-size: 0.9rem;">
                            Modifiez vos informations de base
                        </p>
                    </div>
                    <div class="profile-content">
                        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                            @csrf
                            @method('PATCH')

                            {{-- Nom d'utilisateur --}}
                            <div class="form-group">
                                <label for="name" class="form-label">
                                    Nom d'utilisateur <span style="color: var(--danger);">*</span>
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $user->name) }}" 
                                       required
                                       class="form-input"
                                       placeholder="Votre nom d'utilisateur">
                                @error('name')
                                    <span style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Adresse e-mail --}}
                            <div class="form-group">
                                <label for="email" class="form-label">
                                    Adresse e-mail <span style="color: var(--danger);">*</span>
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $user->email) }}" 
                                       required
                                       class="form-input"
                                       placeholder="votre@email.com">
                                @error('email')
                                    <span style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Prénom et nom en grille --}}
                            <div class="grid md:grid-cols-2" style="gap: 1rem;">
                                <div class="form-group">
                                    <label for="first_name" class="form-label">Prénom</label>
                                    <input type="text" 
                                           id="first_name" 
                                           name="first_name" 
                                           value="{{ old('first_name', $user->first_name) }}" 
                                           class="form-input"
                                           placeholder="Votre prénom">
                                    @error('first_name')
                                        <span style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="last_name" class="form-label">Nom de famille</label>
                                    <input type="text" 
                                           id="last_name" 
                                           name="last_name" 
                                           value="{{ old('last_name', $user->last_name) }}" 
                                           class="form-input"
                                           placeholder="Votre nom de famille">
                                    @error('last_name')
                                        <span style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Bouton de soumission --}}
                            <div style="padding-top: 1rem; border-top: 1px solid var(--border);">
                                <button type="submit" class="button button-primary" style="width: 100%; justify-content: center; font-weight: 600;">
                                    <span>💾</span>
                                    Mettre à jour les informations
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Panneau latéral --}}
            <div class="space-y-6">
                {{-- Informations du compte --}}
                <div class="profile-section">
                    <div class="profile-header">
                        <h3 class="h4" style="display: flex; align-items: center; margin: 0;">
                            <span style="margin-right: 0.5rem; font-size: 1.1rem;">ℹ️</span>
                            Informations du compte
                        </h3>
                    </div>
                    <div class="profile-content space-y-4">
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid var(--border);">
                            <span style="font-weight: 500; color: var(--text-muted);">Rôle :</span>
                            <span style="background: rgba(124, 58, 237, 0.1); color: var(--brand-primary); padding: 0.25rem 0.75rem; border-radius: 50px; font-size: 0.75rem; font-weight: 600; text-transform: capitalize;">
                                {{ $user->role ? ucfirst(str_replace('_', ' ', $user->role->nom_role)) : 'Membre' }}
                            </span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid var(--border);">
                            <span style="font-weight: 500; color: var(--text-muted);">Membre depuis :</span>
                            <span style="font-weight: 500; color: var(--text-primary);">{{ $user->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0;">
                            <span style="font-weight: 500; color: var(--text-muted);">Dernière mise à jour :</span>
                            <span style="font-weight: 500; color: var(--text-primary);">{{ $user->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Statistiques rapides -->
                <div class="profile-section">
                    <div class="profile-header" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                        <h3 style="font-size: 1.125rem; margin: 0; display: flex; align-items: center;">
                            <span style="margin-right: 8px;">��</span>
                            Mes activités
                        </h3>
                    </div>
                    <div class="profile-content">
                        <div class="text-center mb-4">
                            <div style="font-size: 2rem; font-weight: 700; color: #f59e0b; margin-bottom: 8px;">0</div>
                            <div style="font-size: 0.875rem; color: var(--muted);">Séances suivies</div>
                        </div>
                        <div class="text-center">
                            <div style="font-size: 2rem; font-weight: 700; color: var(--brand); margin-bottom: 8px;">{{ $user->created_at->format('d') }}</div>
                            <div style="font-size: 0.875rem; color: var(--muted);">Jours d'ancienneté</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section changement de mot de passe -->
        <div style="margin-top: 32px;">
            <div class="profile-section">
                <div class="profile-header" style="background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);">
                    <h2 style="font-size: 1.25rem; margin: 0; display: flex; align-items: center;">
                        <span style="margin-right: 8px;">🔒</span>
                        Changer le mot de passe
                    </h2>
                </div>
                <div class="profile-content">
                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <!-- Champs cachés pour conserver les autres infos -->
                        <input type="hidden" name="name" value="{{ $user->name }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="first_name" value="{{ $user->first_name }}">
                        <input type="hidden" name="last_name" value="{{ $user->last_name }}">

                        <div class="grid md:grid-cols-3">
                            <!-- Mot de passe actuel -->
                            <div class="form-group">
                                <label for="current_password" class="form-label">Mot de passe actuel</label>
                                <input type="password" 
                                       id="current_password" 
                                       name="current_password" 
                                       class="form-input">
                            </div>

                            {{-- Nouveau mot de passe --}}
                            <div class="form-group">
                                <label for="password" class="form-label">
                                    Nouveau mot de passe
                                </label>
                                <input type="password" 
                                       id="password" 
                                       name="password" 
                                       class="form-input"
                                       placeholder="••••••••">
                                @error('password')
                                    <span style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Confirmation du mot de passe --}}
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">
                                    Confirmer le mot de passe
                                </label>
                                <input type="password" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       class="form-input"
                                       placeholder="••••••••">
                                @error('password_confirmation')
                                    <span style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Informations de sécurité --}}
                        <div style="background: var(--info-light); border: 1px solid var(--info); border-radius: var(--radius); padding: 1rem; margin: 1rem 0;">
                            <div style="display: flex; align-items: center; margin-bottom: 0.5rem;">
                                <span style="margin-right: 0.5rem; font-size: 1.1rem;">ℹ️</span>
                                <span style="font-weight: 600; color: var(--info);">Conseils de sécurité</span>
                            </div>
                            <ul style="margin: 0; padding-left: 1.25rem; color: var(--info); font-size: 0.875rem;">
                                <li>Utilisez au moins 8 caractères</li>
                                <li>Incluez des majuscules, minuscules et chiffres</li>
                                <li>Évitez les informations personnelles</li>
                            </ul>
                        </div>

                        {{-- Bouton de soumission pour mot de passe --}}
                        <div style="padding-top: 1rem; border-top: 1px solid var(--border);">
                            <button type="submit" class="button" style="background: var(--danger); color: white; font-weight: 600;">
                                <span>🔒</span>
                                Changer le mot de passe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Navigation de retour --}}
        <div style="margin-top: 2rem; text-align: center; padding: 1rem 0;">
            <a href="{{ route('dashboard') }}" class="button button-secondary">
                <span>←</span>
                Retour au tableau de bord
            </a>
        </div>
    </div>
</section>
@endsection
