@extends('layouts.app-v2')

@section('title', 'Modifier un Programme - Lyon Palme')

@section('content')
<div class="container" style="padding: 2rem 0;">
    
    <!-- En-tête -->
    <div style="margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <div>
                <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
                    Modifier le Programme
                </h1>
                <p style="color: var(--lp-text-muted); font-size: 1.125rem;">
                    {{ $entrainement->titre }}
                </p>
            </div>
            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('entrainements.show', $entrainement->id) }}" class="btn btn-outline">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    Voir
                </a>
                <a href="{{ route('entrainements.index') }}" class="btn btn-outline">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Retour
                </a>
            </div>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="card">
        <div class="card-header">
            <h2 style="font-size: 1.5rem; font-weight: 600; color: white; margin: 0;">
                Informations du Programme
            </h2>
        </div>
        
        <form action="{{ route('entrainements.update', $entrainement->id) }}" method="POST" style="padding: var(--lp-space-lg);">
            @csrf
            @method('PUT')

            <!-- Messages d'erreur généraux -->
            @if ($errors->any())
                <div class="alert alert-danger" style="margin-bottom: 2rem;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    <div>
                        <strong>Erreurs de validation :</strong>
                        <ul style="margin: 0.5rem 0 0 1.5rem; list-style: disc;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Titre du programme -->
                <div class="form-group" style="grid-column: span 2;">
                    <label for="titre" class="form-label required">
                        <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                        </svg>
                        Titre du programme
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('titre') is-invalid @enderror" 
                        id="titre" 
                        name="titre" 
                        value="{{ old('titre', $entrainement->titre) }}"
                        placeholder="Ex: Perfectionnement Plongée Niveau 2"
                        required
                    >
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Entraîneur -->
                <div class="form-group">
                    <label for="entraineur_id" class="form-label required">
                        <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Entraîneur responsable
                    </label>
                    <select 
                        class="form-select @error('entraineur_id') is-invalid @enderror" 
                        id="entraineur_id" 
                        name="entraineur_id"
                        required
                    >
                        <option value="">Sélectionner un entraîneur...</option>
                        @foreach($entraineurs as $entraineur)
                            <option value="{{ $entraineur->id }}" 
                                {{ old('entraineur_id', $entrainement->entraineur_id) == $entraineur->id ? 'selected' : '' }}>
                                {{ $entraineur->user->name ?? 'Entraîneur #' . $entraineur->id }}
                            </option>
                        @endforeach
                    </select>
                    @error('entraineur_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Niveau -->
                <div class="form-group">
                    <label for="niveau" class="form-label">
                        <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                        Niveau
                    </label>
                    <select 
                        class="form-select @error('niveau') is-invalid @enderror" 
                        id="niveau" 
                        name="niveau"
                    >
                        <option value="">Non spécifié</option>
                        <option value="debutant" {{ old('niveau', $entrainement->niveau) == 'debutant' ? 'selected' : '' }}>Débutant</option>
                        <option value="intermediaire" {{ old('niveau', $entrainement->niveau) == 'intermediaire' ? 'selected' : '' }}>Intermédiaire</option>
                        <option value="avance" {{ old('niveau', $entrainement->niveau) == 'avance' ? 'selected' : '' }}>Avancé</option>
                        <option value="competition" {{ old('niveau', $entrainement->niveau) == 'competition' ? 'selected' : '' }}>Compétition</option>
                    </select>
                    @error('niveau')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-group" style="grid-column: span 2;">
                    <label for="description" class="form-label required">
                        <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                        Description
                    </label>
                    <textarea 
                        class="form-control @error('description') is-invalid @enderror" 
                        id="description" 
                        name="description" 
                        rows="5"
                        placeholder="Décrivez les objectifs, le contenu et les modalités du programme..."
                        required
                    >{{ old('description', $entrainement->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Objectifs -->
                <div class="form-group" style="grid-column: span 2;">
                    <label for="objectifs" class="form-label">
                        <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 6v6l4 2"></path>
                        </svg>
                        Objectifs pédagogiques
                    </label>
                    <textarea 
                        class="form-control @error('objectifs') is-invalid @enderror" 
                        id="objectifs" 
                        name="objectifs" 
                        rows="4"
                        placeholder="Listez les objectifs pédagogiques à atteindre (optionnel)..."
                    >{{ old('objectifs', $entrainement->objectifs) }}</textarea>
                    @error('objectifs')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div style="display: flex; gap: 1rem; justify-content: space-between; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--lp-border);">
                <form action="{{ route('entrainements.destroy', $entrainement->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce programme ? Cette action est irréversible.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                        Supprimer
                    </button>
                </form>

                <div style="display: flex; gap: 1rem;">
                    <a href="{{ route('entrainements.show', $entrainement->id) }}" class="btn btn-outline">
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
                        Enregistrer les modifications
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Statistiques du programme -->
    <div class="grid md:grid-cols-3 gap-6" style="margin-top: 2rem;">
        <div class="card" style="border-left: 4px solid var(--lp-teal);">
            <div style="padding: var(--lp-space-md);">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Séances programmées</div>
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--lp-navy);">
                            {{ $entrainement->seances->count() }}
                        </div>
                    </div>
                    <svg width="32" height="32" fill="none" stroke="var(--lp-teal)" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card" style="border-left: 4px solid var(--lp-marine);">
            <div style="padding: var(--lp-space-md);">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Commentaires</div>
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--lp-navy);">
                            {{ $entrainement->commentaires->count() ?? 0 }}
                        </div>
                    </div>
                    <svg width="32" height="32" fill="none" stroke="var(--lp-marine)" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card" style="border-left: 4px solid var(--lp-navy);">
            <div style="padding: var(--lp-space-md);">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Créé le</div>
                        <div style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy);">
                            {{ $entrainement->created_at->format('d/m/Y') }}
                        </div>
                    </div>
                    <svg width="32" height="32" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
