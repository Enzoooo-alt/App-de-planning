{{-- 
    Liste des Séances - Lyon Palme
    Vue pour l'affichage et la gestion des séances d'entraînement
    Design: Framework CSS Lyon-Palme violet professionnel
--}}
@extends('layouts.app')

@section('title', 'Séances - Lyon Palme')

@section('content')
<section style="padding: 2rem 0;">
    <div class="container">
        
        {{-- En-tête de la page séances --}}
        <div class="profile-section mb-6">
            <div class="profile-header">
                <h1 class="h1" style="display: flex; align-items: center; margin: 0;">
                    <span style="margin-right: 0.75rem; font-size: 2rem;">📅</span>
                    Séances d'Entraînement
                </h1>
                <p style="margin: 0.5rem 0 0; opacity: 0.95; font-size: 1.1rem;">
                    Planning et gestion des créneaux d'entraînement
                </p>
            </div>
            
            {{-- Actions en en-tête --}}
            <div style="margin-top: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: gap;">
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="{{ route('dashboard') }}" class="button button-secondary">
                        <span>←</span>
                        Retour au tableau de bord
                    </a>
                </div>
                
                @if(auth()->check() && auth()->user()->hasAnyRole(['president', 'responsable_planning', 'entraineur']))
                <a href="{{ route('seances.create') }}" class="button button-primary">
                    <span>➕</span>
                    Nouvelle Séance
                </a>
                @endif
            </div>
        </div>

        {{-- Messages de feedback --}}
        @if (session('success'))
            <div class="alert alert-success" style="margin-bottom: 1.5rem; background: var(--success-light); border: 2px solid var(--success); color: var(--success); padding: 1rem 1.25rem; border-radius: var(--radius); display: flex; align-items: center; font-weight: 500;">
                <span style="margin-right: 0.5rem; font-size: 1.1rem;">✅</span>
                {{ session('success') }}
            </div>
        @endif

        {{-- Liste des séances --}}
        <div class="profile-section">
            @if($seances->count() > 0)
                <div class="profile-header">
                    <h2 class="h3" style="margin: 0; display: flex; align-items: center;">
                        <span style="margin-right: 0.5rem; font-size: 1.25rem;">📋</span>
                        Liste des Séances ({{ $seances->total() }} séance{{ $seances->total() > 1 ? 's' : '' }})
                    </h2>
                </div>
                
                <div class="profile-content" style="padding: 0;">
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: left;">📅 Date et Heure</th>
                                    <th style="text-align: left;">🏊‍♀️ Entraînement</th>
                                    <th style="text-align: left;">👨‍🏫 Entraîneur</th>
                                    <th style="text-align: left;">📝 Commentaires</th>
                                    <th style="text-align: center; width: 200px;">⚙️ Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($seances as $seance)
                                    <tr>
                                        <td>
                                            <div style="font-weight: 600; color: var(--brand-primary);">
                                                {{ \Carbon\Carbon::parse($seance->date_seance)->format('d/m/Y') }}
                                            </div>
                                            <div style="font-size: 0.875rem; color: var(--text-muted); margin-top: 2px;">
                                                {{ \Carbon\Carbon::parse($seance->heure_debut)->format('H:i') }} - 
                                                {{ \Carbon\Carbon::parse($seance->heure_fin)->format('H:i') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div style="font-weight: 500;">
                                                {{ $seance->entrainement->titre ?? 'Programme non défini' }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($seance->entrainement && $seance->entrainement->entraineur)
                                                <div style="font-weight: 500;">
                                                    {{ $seance->entrainement->entraineur->prenom }} {{ $seance->entrainement->entraineur->nom }}
                                                </div>
                                            @else
                                                <span style="color: var(--text-muted); font-style: italic;">Non assigné</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div style="color: var(--text-secondary);">
                                                {{ Str::limit($seance->commentaires ?? 'Aucun commentaire', 50) }}
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
                                                <a href="{{ route('seances.show', $seance) }}" class="button button-secondary" style="padding: 6px 12px; font-size: 0.875rem;">
                                                    👁️ Voir
                                                </a>
                                                
                                                @if(auth()->check() && auth()->user()->hasAnyRole(['president', 'responsable_planning', 'entraineur']))
                                                <a href="{{ route('seances.edit', $seance) }}" class="button button-amber" style="padding: 6px 12px; font-size: 0.875rem;">
                                                    ✏️ Modifier
                                                </a>
                                                
                                                <form method="POST" action="{{ route('seances.destroy', $seance) }}" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette séance ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="button" style="background: var(--danger); color: white; padding: 6px 12px; font-size: 0.875rem;">
                                                        🗑️ Supprimer
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pagination --}}
                @if($seances->hasPages())
                    <div style="padding: 1.5rem; border-top: 1px solid var(--border); background: var(--background-subtle);">
                        {{ $seances->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-icon">🏊‍♀️</div>
                    <h3 class="empty-title">Aucune séance programmée</h3>
                    <p class="empty-description">Commencez par programmer votre première séance d'entraînement pour organiser les activités du club.</p>
                    <a href="{{ route('seances.create') }}" class="button button-primary" style="margin-top: 1rem;">
                        <span>📅</span>
                        Programmer une séance
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
