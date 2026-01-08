@extends('layouts.app-v2')

@section('title', 'Créer une actualité')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <!-- Breadcrumb -->
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <a href="{{ route('actualites.index') }}" style="color: var(--lp-teal); text-decoration: none;">Actualités</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">Nouvelle</span>
    </nav>

    <!-- En-tête -->
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
            Créer une actualité
        </h1>
        <p style="color: var(--lp-text-muted);">
            Partagez les dernières nouvelles avec les membres du club
        </p>
    </div>

    <!-- Formulaire -->
    <div class="card">
        <form method="POST" action="{{ route('actualites.store') }}" enctype="multipart/form-data" style="padding: var(--lp-space-lg);">
            @csrf

            <!-- Informations principales -->
            <div style="margin-bottom: 2rem;">
                <h2 style="font-size: 1.25rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid var(--lp-border);">
                    Informations principales
                </h2>

                <!-- Titre -->
                <div class="form-group">
                    <label for="titre" class="form-label required">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 7h16M4 12h16M4 17h10"></path>
                        </svg>
                        Titre de l'actualité
                    </label>
                    <input 
                        type="text" 
                        class="form-input @error('titre') is-invalid @enderror" 
                        id="titre" 
                        name="titre" 
                        value="{{ old('titre') }}" 
                        required 
                        autofocus
                        placeholder="Ex: Résultats du Championnat Régional"
                    >
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contenu -->
                <div class="form-group">
                    <label for="contenu" class="form-label required">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        Contenu
                    </label>
                    <textarea 
                        class="form-input @error('contenu') is-invalid @enderror" 
                        id="contenu" 
                        name="contenu" 
                        rows="10" 
                        required
                        placeholder="Rédigez le contenu de votre actualité..."
                    >{{ old('contenu') }}</textarea>
                    @error('contenu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image -->
                <div class="form-group">
                    <label for="image" class="form-label">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                        Image d'illustration (optionnelle)
                    </label>
                    <input 
                        type="file" 
                        class="form-input @error('image') is-invalid @enderror" 
                        id="image" 
                        name="image"
                        accept="image/jpeg,image/png,image/jpg,image/gif"
                    >
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small style="color: var(--lp-text-muted); font-size: 0.875rem; display: block; margin-top: 0.25rem;">
                        Formats acceptés: JPG, PNG, GIF. Taille max: 2 MB
                    </small>
                </div>
            </div>

            <!-- Catégorie et publication -->
            <div style="margin-bottom: 2rem;">
                <h2 style="font-size: 1.25rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid var(--lp-border);">
                    Catégorie et publication
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Catégorie -->
                    <div class="form-group">
                        <label for="categorie" class="form-label required">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            Catégorie
                        </label>
                        <select 
                            class="form-select @error('categorie') is-invalid @enderror" 
                            id="categorie" 
                            name="categorie" 
                            required
                        >
                            <option value="">Sélectionnez une catégorie</option>
                            <option value="info" {{ old('categorie') == 'info' ? 'selected' : '' }}>ℹ️ Information</option>
                            <option value="evenement" {{ old('categorie') == 'evenement' ? 'selected' : '' }}>🎉 Événement</option>
                            <option value="competition" {{ old('categorie') == 'competition' ? 'selected' : '' }}>🏆 Compétition</option>
                            <option value="resultat" {{ old('categorie') == 'resultat' ? 'selected' : '' }}>✅ Résultat</option>
                        </select>
                        @error('categorie')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Statut -->
                    <div class="form-group">
                        <label for="statut" class="form-label required">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M12 6v6l4 2"></path>
                            </svg>
                            Statut
                        </label>
                        <select 
                            class="form-select @error('statut') is-invalid @enderror" 
                            id="statut" 
                            name="statut" 
                            required
                        >
                            <option value="brouillon" {{ old('statut') == 'brouillon' ? 'selected' : '' }}>📝 Brouillon</option>
                            <option value="publie" {{ old('statut', 'publie') == 'publie' ? 'selected' : '' }}>✅ Publié</option>
                        </select>
                        @error('statut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small style="color: var(--lp-text-muted); font-size: 0.875rem; display: block; margin-top: 0.25rem;">
                            Les brouillons ne sont visibles que par les administrateurs
                        </small>
                    </div>
                </div>

                <!-- Épingler -->
                <div class="form-group" style="margin-top: 1rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input 
                            type="checkbox" 
                            name="epingle" 
                            id="epingle"
                            value="1"
                            {{ old('epingle') ? 'checked' : '' }}
                            style="width: 1.25rem; height: 1.25rem; cursor: pointer;"
                        >
                        <span style="font-weight: 600; color: var(--lp-navy);">
                            📌 Épingler cette actualité
                        </span>
                    </label>
                    <small style="color: var(--lp-text-muted); font-size: 0.875rem; display: block; margin-top: 0.25rem; margin-left: 1.75rem;">
                        Les actualités épinglées apparaissent en haut de la liste "À la une"
                    </small>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div style="display: flex; gap: 1rem; justify-content: flex-end; padding-top: 1.5rem; border-top: 1px solid var(--lp-border);">
                <a href="{{ route('actualites.index') }}" class="btn btn-secondary">
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
                    Créer l'actualité
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
