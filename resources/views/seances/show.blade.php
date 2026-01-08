@extends('layouts.app')

@section('title', 'Détails Séance - Lyon Palme')

@section('content')
    <div class="container" style="max-width: 1000px; margin: 0 auto; padding: 2rem 1.5rem;">
        
        {{-- En-tête avec titre et actions --}}
        <div style="margin-bottom: 2rem;">
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem;">
                Séance du {{ \Carbon\Carbon::parse($seance->date_seance)->format('d/m/Y') }}
            </h1>
            <p style="color: var(--text-muted); font-size: 1.125rem;">
                {{ $seance->heure_debut }} - {{ $seance->heure_fin }}
            </p>
            
            {{-- Actions en en-tête --}}
            <div style="margin-top: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: gap;">
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="{{ route('seances.index') }}" class="button button-secondary">
                        <span>←</span>
                        Retour à la liste
                    </a>
                </div>
                
                @if(auth()->check() && auth()->user()->hasAnyRole(['president', 'responsable_planning', 'entraineur']))
                <div style="display: flex; gap: 0.75rem;">
                    <a href="{{ route('presences.manage', $seance) }}" class="button" style="background: var(--lp-teal); color: white;">
                        📋 Feuille de présence
                    </a>
                    <a href="{{ route('seances.edit', $seance) }}" class="button" style="background: var(--warning); color: white;">
                        ✏️ Modifier
                    </a>
                    <form method="POST" action="{{ route('seances.destroy', $seance) }}" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette séance ?')">
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

        {{-- Carte d'informations de la séance --}}
        <div class="card" style="margin-bottom: 2rem;">
            <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary); margin-bottom: 1.5rem;">
                Informations de la séance
            </h2>
            
            <div style="display: grid; gap: 2rem;">
                <div>
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                        Date et horaires
                    </h3>
                    <p style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary);">
                        {{ \Carbon\Carbon::parse($seance->date_seance)->format('l d F Y') }}
                    </p>
                    <p style="font-size: 1rem; font-weight: 500; color: var(--brand-primary); margin-top: 0.25rem;">
                        De {{ $seance->heure_debut }} à {{ $seance->heure_fin }}
                    </p>
                </div>
                
                <div>
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                        Lieu
                    </h3>
                    <p style="font-size: 1.125rem; font-weight: 500; color: var(--text-primary);">
                        📍 {{ $seance->lieu }}
                    </p>
                </div>
                
                <div>
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                        Programme d'entraînement
                    </h3>
                    <div class="card" style="background: var(--bg-secondary); padding: 1rem; border: 2px solid var(--border);">
                        <h4 style="font-size: 1rem; font-weight: 600; color: var(--text-primary); margin-bottom: 0.5rem;">
                            {{ $seance->entrainement->titre }}
                        </h4>
                        @if($seance->entrainement->niveau)
                        <div style="display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 0.75rem; font-weight: 600; background: var(--brand-primary); color: white; margin-bottom: 0.5rem;">
                            {{ ucfirst($seance->entrainement->niveau) }}
                        </div>
                        @endif
                        <p style="font-size: 0.875rem; color: var(--text-muted);">
                            Entraîneur : {{ $seance->entrainement->entraineur->prenom }} {{ $seance->entrainement->entraineur->nom }}
                        </p>
                        <a href="{{ route('entrainements.show', $seance->entrainement) }}" class="button button-secondary" style="margin-top: 0.75rem; font-size: 0.875rem; padding: 6px 12px;">
                            Voir le programme complet
                        </a>
                    </div>
                </div>
                
                @if($seance->commentaires)
                <div>
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                        Commentaires / Notes
                    </h3>
                    <div class="card" style="background: var(--info-light); border: 2px solid var(--info); padding: 1.25rem;">
                        <p style="font-size: 1rem; color: var(--text-primary); line-height: 1.6;">
                            {{ $seance->commentaires }}
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Informations complémentaires --}}
        <div class="card" style="background: var(--bg-secondary);">
            <h3 style="font-size: 1rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1rem;">
                ℹ️ Informations complémentaires
            </h3>
            <div style="display: grid; gap: 0.75rem; font-size: 0.9375rem; color: var(--text-muted);">
                <div style="display: flex; justify-content: space-between;">
                    <span>Durée de la séance :</span>
                    <strong style="color: var(--text-primary);">
                        @php
                            $debut = \Carbon\Carbon::parse($seance->date_seance . ' ' . $seance->heure_debut);
                            $fin = \Carbon\Carbon::parse($seance->date_seance . ' ' . $seance->heure_fin);
                            $duree = $debut->diff($fin);
                        @endphp
                        {{ $duree->h }}h{{ $duree->i > 0 ? sprintf('%02d', $duree->i) : '' }}
                    </strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span>Créée le :</span>
                    <strong style="color: var(--text-primary);">
                        {{ \Carbon\Carbon::parse($seance->created_at)->format('d/m/Y à H:i') }}
                    </strong>
                </div>
                @if($seance->updated_at != $seance->created_at)
                <div style="display: flex; justify-content: space-between;">
                    <span>Dernière modification :</span>
                    <strong style="color: var(--text-primary);">
                        {{ \Carbon\Carbon::parse($seance->updated_at)->format('d/m/Y à H:i') }}
                    </strong>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
