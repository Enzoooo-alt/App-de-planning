@extends('layouts.app')

@section('title', 'Nouvel Entraîneur - Lyon Palme')

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto; padding: 2rem 1.5rem;">
        
        <div style="margin-bottom: 2rem;">
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem;">
                Nouvel Entraîneur
            </h1>
            <p style="color: var(--text-muted);">
                Créez un nouveau profil d'entraîneur pour le club
            </p>
        </div>

        <div class="card">
            <form method="POST" action="{{ route('entraineurs.store') }}">
                @csrf

                <div style="display: grid; gap: 1.5rem;">
                    {{-- Nom --}}
                    <div>
                        <label for="nom" style="display: block; font-weight: 600; color: var(--text-primary); margin-bottom: 0.5rem;">
                            Nom <span style="color: var(--danger);">*</span>
                        </label>
                        <input type="text" id="nom" name="nom" value="{{ old('nom') }}" 
                               class="form-input @error('nom') error @enderror"
                               style="width: 100%; padding: 0.75rem; border: 2px solid var(--border); border-radius: var(--radius); font-size: 1rem;"
                               required>
                        @error('nom')
                            <span style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Prénom --}}
                    <div>
                        <label for="prenom" style="display: block; font-weight: 600; color: var(--text-primary); margin-bottom: 0.5rem;">
                            Prénom <span style="color: var(--danger);">*</span>
                        </label>
                        <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" 
                               class="form-input @error('prenom') error @enderror"
                               style="width: 100%; padding: 0.75rem; border: 2px solid var(--border); border-radius: var(--radius); font-size: 1rem;"
                               required>
                        @error('prenom')
                            <span style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Rôle / Spécialité --}}
                    <div>
                        <label for="role" style="display: block; font-weight: 600; color: var(--text-primary); margin-bottom: 0.5rem;">
                            Spécialité / Rôle
                        </label>
                        <input type="text" id="role" name="role" value="{{ old('role') }}" 
                               class="form-input @error('role') error @enderror"
                               style="width: 100%; padding: 0.75rem; border: 2px solid var(--border); border-radius: var(--radius); font-size: 1rem;"
                               placeholder="Ex: Natation synchronisée, Compétition, Débutants...">
                        @error('role')
                            <span style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Login --}}
                    <div>
                        <label for="login" style="display: block; font-weight: 600; color: var(--text-primary); margin-bottom: 0.5rem;">
                            Identifiant de connexion <span style="color: var(--danger);">*</span>
                        </label>
                        <input type="text" id="login" name="login" value="{{ old('login') }}" 
                               class="form-input @error('login') error @enderror"
                               style="width: 100%; padding: 0.75rem; border: 2px solid var(--border); border-radius: var(--radius); font-size: 1rem;"
                               required>
                        @error('login')
                            <span style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Mot de passe --}}
                    <div>
                        <label for="mot_de_passe" style="display: block; font-weight: 600; color: var(--text-primary); margin-bottom: 0.5rem;">
                            Mot de passe <span style="color: var(--danger);">*</span>
                        </label>
                        <input type="password" id="mot_de_passe" name="mot_de_passe" 
                               class="form-input @error('mot_de_passe') error @enderror"
                               style="width: 100%; padding: 0.75rem; border: 2px solid var(--border); border-radius: var(--radius); font-size: 1rem;"
                               required minlength="6">
                        <small style="color: var(--text-muted); font-size: 0.875rem; margin-top: 0.25rem; display: block;">
                            Minimum 6 caractères
                        </small>
                        @error('mot_de_passe')
                            <span style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Boutons d'action --}}
                <div style="display: flex; gap: 1rem; margin-top: 2rem; padding-top: 2rem; border-top: 2px solid var(--border);">
                    <a href="{{ route('entraineurs.index') }}" class="button button-secondary">
                        Annuler
                    </a>
                    <button type="submit" class="button button-primary" style="margin-left: auto;">
                        ✓ Créer l'entraîneur
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
