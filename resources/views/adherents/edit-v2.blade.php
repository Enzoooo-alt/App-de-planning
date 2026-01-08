@extends('layouts.app-v2')

@section('title', 'Modifier un Adhérent - Lyon Palme')

@section('content')
<div class="container" style="padding: 2rem 0;">
    
    <!-- En-tête -->
    <div style="margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <div>
                <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
                    Modifier l'Adhérent
                </h1>
                <p style="color: var(--lp-text-muted); font-size: 1.125rem;">
                    {{ $adherent->prenom }} {{ $adherent->nom }}
                </p>
            </div>
            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('adherents.show', $adherent->id) }}" class="btn btn-outline">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    Voir
                </a>
                <a href="{{ route('adherents.index') }}" class="btn btn-outline">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Retour
                </a>
            </div>
        </div>
    </div>

    <!-- Statistiques de l'adhérent -->
    <div class="grid md:grid-cols-3 gap-6" style="margin-bottom: 2rem;">
        <div class="card" style="border-left: 4px solid var(--lp-navy);">
            <div style="padding: var(--lp-space-md);">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Ancienneté</div>
                        <div style="font-size: 1.25rem; font-weight: 600; color: var(--lp-navy);">
                            {{ $adherent->date_adhesion->diffForHumans() }}
                        </div>
                    </div>
                    <svg width="32" height="32" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card" style="border-left: 4px solid var(--lp-teal);">
            <div style="padding: var(--lp-space-md);">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Statut</div>
                        <div style="margin-top: 0.5rem;">
                            @if($adherent->actif)
                                <span class="badge badge-success">Actif</span>
                            @else
                                <span class="badge badge-danger">Inactif</span>
                            @endif
                        </div>
                    </div>
                    <svg width="32" height="32" fill="none" stroke="var(--lp-teal)" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card" style="border-left: 4px solid var(--lp-marine);">
            <div style="padding: var(--lp-space-md);">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Niveau</div>
                        <div style="font-size: 1.25rem; font-weight: 600; color: var(--lp-navy);">
                            @if($adherent->niveau)
                                {{ ucfirst($adherent->niveau) }}
                            @else
                                Non défini
                            @endif
                        </div>
                    </div>
                    <svg width="32" height="32" fill="none" stroke="var(--lp-marine)" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="card">
        <div class="card-header">
            <h2 style="font-size: 1.5rem; font-weight: 600; color: white; margin: 0;">
                Informations de l'Adhérent
            </h2>
        </div>
        
        <form action="{{ route('adherents.update', $adherent->id) }}" method="POST" style="padding: var(--lp-space-lg);">
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
                <!-- Nom -->
                <div class="form-group">
                    <label for="nom" class="form-label required">
                        <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Nom
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('nom') is-invalid @enderror" 
                        id="nom" 
                        name="nom" 
                        value="{{ old('nom', $adherent->nom) }}"
                        placeholder="Nom de famille"
                        required
                    >
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Prénom -->
                <div class="form-group">
                    <label for="prenom" class="form-label required">
                        <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Prénom
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('prenom') is-invalid @enderror" 
                        id="prenom" 
                        name="prenom" 
                        value="{{ old('prenom', $adherent->prenom) }}"
                        placeholder="Prénom"
                        required
                    >
                    @error('prenom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label required">
                        <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        Email
                    </label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        id="email" 
                        name="email" 
                        value="{{ old('email', $adherent->email) }}"
                        placeholder="email@exemple.fr"
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Téléphone -->
                <div class="form-group">
                    <label for="telephone" class="form-label">
                        <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        Téléphone
                    </label>
                    <input 
                        type="tel" 
                        class="form-control @error('telephone') is-invalid @enderror" 
                        id="telephone" 
                        name="telephone" 
                        value="{{ old('telephone', $adherent->telephone) }}"
                        placeholder="06 12 34 56 78"
                    >
                    @error('telephone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Date d'adhésion -->
                <div class="form-group">
                    <label for="date_adhesion" class="form-label required">
                        <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        Date d'adhésion
                    </label>
                    <input 
                        type="date" 
                        class="form-control @error('date_adhesion') is-invalid @enderror" 
                        id="date_adhesion" 
                        name="date_adhesion" 
                        value="{{ old('date_adhesion', $adherent->date_adhesion->format('Y-m-d')) }}"
                        max="{{ date('Y-m-d') }}"
                        required
                    >
                    @error('date_adhesion')
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
                        <option value="">Sélectionner un niveau...</option>
                        <option value="debutant" {{ old('niveau', $adherent->niveau) == 'debutant' ? 'selected' : '' }}>Débutant</option>
                        <option value="intermediaire" {{ old('niveau', $adherent->niveau) == 'intermediaire' ? 'selected' : '' }}>Intermédiaire</option>
                        <option value="avance" {{ old('niveau', $adherent->niveau) == 'avance' ? 'selected' : '' }}>Avancé</option>
                        <option value="competition" {{ old('niveau', $adherent->niveau) == 'competition' ? 'selected' : '' }}>Compétition</option>
                    </select>
                    @error('niveau')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Compte utilisateur associé -->
                <div class="form-group" style="grid-column: span 2;">
                    <label for="user_id" class="form-label">
                        <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <polyline points="17 11 19 13 23 9"></polyline>
                        </svg>
                        Compte utilisateur (optionnel)
                    </label>
                    <select 
                        class="form-select @error('user_id') is-invalid @enderror" 
                        id="user_id" 
                        name="user_id"
                    >
                        <option value="">Aucun compte associé</option>
                        @foreach($users ?? [] as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $adherent->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text">Lier cet adhérent à un compte utilisateur existant pour lui donner accès à la plateforme</small>
                </div>

                <!-- Actif -->
                <div class="form-group" style="grid-column: span 2;">
                    <div class="form-check">
                        <input 
                            type="checkbox" 
                            class="form-check-input @error('actif') is-invalid @enderror" 
                            id="actif" 
                            name="actif"
                            value="1"
                            {{ old('actif', $adherent->actif) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="actif">
                            <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Adhérent actif (cotisation à jour)
                        </label>
                        @error('actif')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div style="display: flex; gap: 1rem; justify-content: space-between; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--lp-border);">
                <form action="{{ route('adherents.destroy', $adherent->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet adhérent ? Cette action est irréversible.');">
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
                    <a href="{{ route('adherents.show', $adherent->id) }}" class="btn btn-outline">
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
</div>
@endsection
