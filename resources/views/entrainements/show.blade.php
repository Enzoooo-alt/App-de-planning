@extends('layouts.app')

@section('title', 'Détails Entraînement - Lyon Palme')

@section('content')
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 2rem 1.5rem;">
        
        {{-- En-tête avec titre et actions --}}
        <div style="margin-bottom: 2rem;">
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem;">
                {{ $entrainement->titre }}
            </h1>
            
            @if($entrainement->niveau)
            <div style="display: inline-block; padding: 6px 16px; border-radius: 20px; font-size: 0.875rem; font-weight: 600; margin-bottom: 1rem; background: var(--brand-primary); color: white;">
                Niveau : {{ ucfirst($entrainement->niveau) }}
            </div>
            @endif
            
            {{-- Actions en en-tête --}}
            <div style="margin-top: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: gap;">
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="{{ route('entrainements.index') }}" class="button button-secondary">
                        <span>←</span>
                        Retour à la liste
                    </a>
                </div>
                
                @if(auth()->check() && auth()->user()->hasAnyRole(['president', 'responsable_planning', 'entraineur']))
                <div style="display: flex; gap: 0.75rem;">
                    <a href="{{ route('entrainements.edit', $entrainement) }}" class="button" style="background: var(--warning); color: white;">
                        ✏️ Modifier
                    </a>
                    <form method="POST" action="{{ route('entrainements.destroy', $entrainement) }}" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce programme ?')">
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

        {{-- Carte d'informations du programme --}}
        <div class="card" style="margin-bottom: 2rem;">
            <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary); margin-bottom: 1.5rem;">
                Informations du programme
            </h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
                <div>
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                        Entraîneur responsable
                    </h3>
                    <p style="font-size: 1.125rem; font-weight: 600; color: var(--brand-primary);">
                        {{ $entrainement->entraineur->prenom }} {{ $entrainement->entraineur->nom }}
                    </p>
                    @if($entrainement->entraineur->role)
                    <p style="font-size: 0.875rem; color: var(--text-muted); margin-top: 0.25rem;">
                        {{ $entrainement->entraineur->role }}
                    </p>
                    @endif
                </div>
                
                <div>
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                        Nombre de séances
                    </h3>
                    <p style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary);">
                        {{ $entrainement->seances->count() }} séance{{ $entrainement->seances->count() > 1 ? 's' : '' }}
                    </p>
                </div>
            </div>
            
            @if($entrainement->description)
            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                    Description
                </h3>
                <p style="font-size: 1rem; color: var(--text-primary); line-height: 1.6;">
                    {{ $entrainement->description }}
                </p>
            </div>
            @endif
            
            @if($entrainement->objectifs)
            <div>
                <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                    Objectifs
                </h3>
                <p style="font-size: 1rem; color: var(--text-primary); line-height: 1.6;">
                    {{ $entrainement->objectifs }}
                </p>
            </div>
            @endif
        </div>

        {{-- Section des séances --}}
        <div class="card">
            <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                <span style="font-size: 1.75rem;">📅</span>
                Séances planifiées
            </h2>
            
            @if($entrainement->seances->count() > 0)
                <div style="display: grid; gap: 1rem;">
                    @foreach($entrainement->seances->sortBy('date_seance') as $seance)
                        <div class="card" style="background: var(--bg-secondary); border: 2px solid var(--border); padding: 1.25rem;">
                            <div style="display: flex; justify-content: space-between; align-items: start;">
                                <div style="flex: 1;">
                                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.75rem;">
                                        <h4 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary);">
                                            {{ \Carbon\Carbon::parse($seance->date_seance)->format('d/m/Y') }}
                                        </h4>
                                        <span style="color: var(--text-muted);">•</span>
                                        <span style="font-weight: 500; color: var(--brand-primary);">
                                            {{ $seance->heure_debut }} - {{ $seance->heure_fin }}
                                        </span>
                                    </div>
                                    
                                    <p style="color: var(--text-muted); font-size: 0.9375rem; margin-bottom: 0.5rem;">
                                        📍 {{ $seance->lieu }}
                                    </p>
                                    
                                    @if($seance->commentaires)
                                    <p style="color: var(--text-primary); font-size: 0.9375rem; line-height: 1.6; margin-top: 0.75rem;">
                                        {{ $seance->commentaires }}
                                    </p>
                                    @endif
                                </div>
                                
                                <a href="{{ route('seances.show', $seance) }}" class="button button-secondary" style="margin-left: 1rem;">
                                    Voir détails
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 3rem 1rem; color: var(--text-muted);">
                    <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;">📆</div>
                    <p style="font-size: 1.125rem; font-weight: 500;">
                        Aucune séance planifiée pour ce programme
                    </p>
                    @if(auth()->check() && auth()->user()->hasAnyRole(['president', 'responsable_planning', 'entraineur']))
                    <a href="{{ route('seances.create') }}" class="button button-primary" style="margin-top: 1rem;">
                        Créer une séance
                    </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
