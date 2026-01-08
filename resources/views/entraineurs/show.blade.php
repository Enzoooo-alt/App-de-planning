@extends('layouts.app')

@section('title', 'Détails Entraîneur - Lyon Palme')

@section('content')
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 2rem 1.5rem;">
        
        {{-- En-tête avec titre et actions --}}
        <div style="margin-bottom: 2rem;">
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem;">
                {{ $entraineur->prenom }} {{ $entraineur->nom }}
            </h1>
            
            {{-- Actions en en-tête --}}
            <div style="margin-top: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: gap;">
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="{{ route('entraineurs.index') }}" class="button button-secondary">
                        <span>←</span>
                        Retour à la liste
                    </a>
                </div>
                
                @if(auth()->check() && auth()->user()->hasAnyRole(['president', 'responsable_planning']))
                <div style="display: flex; gap: 0.75rem;">
                    <a href="{{ route('entraineurs.edit', $entraineur) }}" class="button" style="background: var(--warning); color: white;">
                        ✏️ Modifier
                    </a>
                    <form method="POST" action="{{ route('entraineurs.destroy', $entraineur) }}" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet entraîneur ?')">
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

        {{-- Carte d'informations de l'entraîneur --}}
        <div class="card" style="margin-bottom: 2rem;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                <div>
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                        Nom complet
                    </h3>
                    <p style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary);">
                        {{ $entraineur->prenom }} {{ $entraineur->nom }}
                    </p>
                </div>
                
                @if($entraineur->role)
                <div>
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                        Spécialité / Rôle
                    </h3>
                    <p style="font-size: 1.125rem; font-weight: 600; color: var(--brand-primary);">
                        {{ $entraineur->role }}
                    </p>
                </div>
                @endif
                
                @if($entraineur->login && auth()->check() && auth()->user()->hasAnyRole(['president', 'responsable_planning']))
                <div>
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                        Identifiant de connexion
                    </h3>
                    <p style="font-size: 1.125rem; font-weight: 500; color: var(--text-primary); font-family: monospace;">
                        {{ $entraineur->login }}
                    </p>
                </div>
                @endif

                @if($entraineur->user_id)
                <div>
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                        Compte utilisateur
                    </h3>
                    <p style="font-size: 1.125rem; font-weight: 500; color: var(--success);">
                        ✓ Compte actif
                    </p>
                </div>
                @endif
            </div>
        </div>

        {{-- Section des programmes d'entraînement --}}
        <div class="card">
            <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                <span style="font-size: 1.75rem;">🏊‍♀️</span>
                Programmes d'entraînement assignés
            </h2>
            
            @if($entraineur->entrainements->count() > 0)
                <div style="display: grid; gap: 1rem;">
                    @foreach($entraineur->entrainements as $entrainement)
                        <div class="card" style="background: var(--bg-secondary); border: 2px solid var(--border); padding: 1.25rem;">
                            <div style="display: flex; justify-content: space-between; align-items: start;">
                                <div style="flex: 1;">
                                    <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-bottom: 0.5rem;">
                                        {{ $entrainement->titre }}
                                    </h3>
                                    
                                    @if($entrainement->niveau)
                                    <div style="display: inline-block; padding: 4px 12px; background: var(--brand-primary); color: white; border-radius: 12px; font-size: 0.75rem; font-weight: 600; margin-bottom: 0.75rem;">
                                        {{ ucfirst($entrainement->niveau) }}
                                    </div>
                                    @endif
                                    
                                    @if($entrainement->description)
                                    <p style="color: var(--text-muted); font-size: 0.9375rem; margin-bottom: 0.75rem; line-height: 1.6;">
                                        {{ Str::limit($entrainement->description, 200) }}
                                    </p>
                                    @endif
                                    
                                    <div style="display: flex; gap: 1.5rem; margin-top: 1rem; font-size: 0.875rem; color: var(--text-muted);">
                                        <div>
                                            <strong style="color: var(--text-primary);">{{ $entrainement->seances->count() }}</strong> séance{{ $entrainement->seances->count() > 1 ? 's' : '' }}
                                        </div>
                                    </div>
                                </div>
                                
                                <a href="{{ route('entrainements.show', $entrainement) }}" class="button button-secondary" style="margin-left: 1rem;">
                                    Voir détails
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 3rem 1rem; color: var(--text-muted);">
                    <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;">📋</div>
                    <p style="font-size: 1.125rem; font-weight: 500;">
                        Aucun programme d'entraînement assigné pour le moment
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
