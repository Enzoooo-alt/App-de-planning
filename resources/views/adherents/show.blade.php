@extends('layouts.app')

@section('title', 'Détails Adhérent - Lyon Palme')

@section('content')
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 2rem 1.5rem;">
        
        {{-- En-tête avec titre et actions --}}
        <div style="margin-bottom: 2rem;">
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem;">
                {{ $adherent->prenom }} {{ $adherent->nom }}
            </h1>
            
            {{-- Statut actif/inactif --}}
            <div style="display: inline-block; padding: 6px 16px; border-radius: 20px; font-size: 0.875rem; font-weight: 600; margin-bottom: 1rem;
                        background: {{ $adherent->actif ? 'var(--success-light)' : 'var(--danger-light)' }};
                        color: {{ $adherent->actif ? 'var(--success)' : 'var(--danger)' }};">
                {{ $adherent->actif ? '✓ Actif' : '✗ Inactif' }}
            </div>
            
            {{-- Actions en en-tête --}}
            <div style="margin-top: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: gap;">
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="{{ route('adherents.index') }}" class="button button-secondary">
                        <span>←</span>
                        Retour à la liste
                    </a>
                </div>
                
                @if(auth()->check() && auth()->user()->hasAnyRole(['president', 'responsable_planning']))
                <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                    @if(auth()->user()->hasAnyRole(['president', 'responsable_planning', 'entraineur']))
                    <a href="{{ route('presences.statistics', $adherent) }}" class="button" style="background: #10b981; color: white;">
                        📋 Statistiques de présence
                    </a>
                    @endif
                    
                    @if(auth()->user()->hasAnyRole(['president', 'responsable_planning']))
                    <a href="{{ route('paiements.index', ['adherent_id' => $adherent->id]) }}" class="button" style="background: var(--lp-teal); color: white;">
                        💰 Historique de paiements
                    </a>
                    @endif
                    
                    <a href="{{ route('adherents.edit', $adherent) }}" class="button" style="background: var(--warning); color: white;">
                        ✏️ Modifier
                    </a>
                    <form method="POST" action="{{ route('adherents.destroy', $adherent) }}" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet adhérent ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button" style="background: var(--danger); color: white;">
                            🗑️ Supprimer
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>

        {{-- Carte d'informations personnelles --}}
        <div class="card" style="margin-bottom: 2rem;">
            <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary); margin-bottom: 1.5rem;">
                Informations personnelles
            </h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                <div>
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                        Nom complet
                    </h3>
                    <p style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary);">
                        {{ $adherent->prenom }} {{ $adherent->nom }}
                    </p>
                </div>
                
                <div>
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                        Email
                    </h3>
                    <p style="font-size: 1.125rem; font-weight: 500; color: var(--brand-primary);">
                        <a href="mailto:{{ $adherent->email }}" style="color: var(--brand-primary); text-decoration: none;">
                            {{ $adherent->email }}
                        </a>
                    </p>
                </div>
                
                @if($adherent->telephone)
                <div>
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                        Téléphone
                    </h3>
                    <p style="font-size: 1.125rem; font-weight: 500; color: var(--text-primary);">
                        {{ $adherent->telephone }}
                    </p>
                </div>
                @endif
                
                <div>
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                        Date d'adhésion
                    </h3>
                    <p style="font-size: 1.125rem; font-weight: 500; color: var(--text-primary);">
                        {{ \Carbon\Carbon::parse($adherent->date_adhesion)->format('d/m/Y') }}
                    </p>
                </div>
                
                @if($adherent->niveau)
                <div>
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                        Niveau
                    </h3>
                    <div style="display: inline-block; padding: 6px 16px; border-radius: 16px; font-size: 0.875rem; font-weight: 600; background: var(--brand-primary); color: white;">
                        {{ ucfirst($adherent->niveau) }}
                    </div>
                </div>
                @endif

                @if($adherent->user_id)
                <div>
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                        Compte utilisateur
                    </h3>
                    <p style="font-size: 1.125rem; font-weight: 500; color: var(--success);">
                        ✓ Compte actif lié
                    </p>
                </div>
                @endif
            </div>
        </div>

        {{-- Section pour créer un compte utilisateur --}}
        @if(!$adherent->user_id && auth()->check() && auth()->user()->hasAnyRole(['president', 'responsable_planning']))
        <div class="card" style="margin-bottom: 2rem; background: var(--lp-bg-ocean);">
            <div style="display: flex; align-items: start; gap: 1rem;">
                <div style="flex-shrink: 0; width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-navy), var(--lp-teal)); color: white; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    👤
                </div>
                <div style="flex: 1;">
                    <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
                        Créer un compte utilisateur
                    </h2>
                    <p style="color: var(--lp-text-muted); margin-bottom: 1.5rem;">
                        Cet adhérent n'a pas encore de compte utilisateur. Créez-en un pour qu'il puisse accéder à l'application.
                    </p>
                    
                    <!-- Bouton pour ouvrir le formulaire -->
                    <button onclick="document.getElementById('create-account-form').style.display='block'; this.style.display='none';" 
                            class="btn btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <line x1="20" y1="8" x2="20" y2="14"></line>
                            <line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                        Créer un compte
                    </button>
                    
                    <!-- Formulaire de création (caché par défaut) -->
                    <form id="create-account-form" 
                          method="POST" 
                          action="{{ route('adherents.assign-member-role', $adherent) }}" 
                          style="display: none; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--lp-border);">
                        @csrf
                        
                        <div class="form-group">
                            <label for="email" class="form-label required">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                Email de connexion
                            </label>
                            <input 
                                type="email" 
                                class="form-input @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', $adherent->email) }}" 
                                required
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
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
                                minlength="8"
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small style="color: var(--lp-text-muted); font-size: 0.875rem; display: block; margin-top: 0.25rem;">
                                Minimum 8 caractères
                            </small>
                        </div>
                        
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
                                minlength="8"
                            >
                        </div>
                        
                        <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                            <button type="submit" class="btn btn-primary">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                    <polyline points="7 3 7 8 15 8"></polyline>
                                </svg>
                                Créer le compte
                            </button>
                            <button type="button" 
                                    onclick="document.getElementById('create-account-form').style.display='none'; document.querySelector('button[onclick*=create-account-form]').style.display='block';"
                                    class="btn btn-secondary">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

        {{-- Section des commentaires --}}
        <div class="card">
            <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                <span style="font-size: 1.75rem;">💬</span>
                Commentaires et suivis
            </h2>
            
            @if($adherent->commentaires->count() > 0)
                <div style="display: grid; gap: 1rem;">
                    @foreach($adherent->commentaires as $commentaire)
                        <div class="card" style="background: var(--bg-secondary); border: 2px solid var(--border); padding: 1.25rem;">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.75rem;">
                                <div>
                                    <h4 style="font-weight: 600; color: var(--text-primary); margin-bottom: 0.25rem;">
                                        Programme : {{ $commentaire->entrainement->titre ?? 'N/A' }}
                                    </h4>
                                    <p style="font-size: 0.875rem; color: var(--text-muted);">
                                        {{ \Carbon\Carbon::parse($commentaire->created_at)->format('d/m/Y à H:i') }}
                                    </p>
                                </div>
                            </div>
                            <p style="color: var(--text-primary); line-height: 1.6;">
                                {{ $commentaire->texte }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 3rem 1rem; color: var(--text-muted);">
                    <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;">📝</div>
                    <p style="font-size: 1.125rem; font-weight: 500;">
                        Aucun commentaire pour le moment
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
