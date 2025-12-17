{{-- 
    Liste des Entraînements - Lyon Palme
    Vue pour l'affichage et la gestion des programmes d'entraînement
    Design: Framework CSS Lyon-Palme violet professionnel
--}}
@extends('layouts.app')

@section('title', 'Entraînements - Lyon Palme')

@section('content')
<section style="padding: 2rem 0;">
    <div class="container">
        
        {{-- En-tête de la page entraînements --}}
        <div class="profile-section mb-6">
            <div class="profile-header">
                <h1 class="h1" style="display: flex; align-items: center; margin: 0;">
                    <span style="margin-right: 0.75rem; font-size: 2rem;">🏊‍♀️</span>
                    Programmes d'Entraînement
                </h1>
                <p style="margin: 0.5rem 0 0; opacity: 0.95; font-size: 1.1rem;">
                    Gestion des programmes et méthodes d'entraînement du club
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
                
                @if(auth()->user()->canManageEntrainements())
                <a href="{{ route('entrainements.create') }}" class="button button-primary">
                    <span>➕</span>
                    Nouvel Entraînement
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

        {{-- Liste des entraînements --}}
        <div class="profile-section">
            @if($entrainements->count() > 0)
                <div class="profile-header">
                    <h2 class="h3" style="margin: 0; display: flex; align-items: center;">
                        <span style="margin-right: 0.5rem; font-size: 1.25rem;">📚</span>
                        Programmes Disponibles ({{ $entrainements->total() }} programme{{ $entrainements->total() > 1 ? 's' : '' }})
                    </h2>
                </div>
                
                <div class="profile-content" style="padding: 0;">
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: left;">🏷️ Titre du Programme</th>
                                    <th style="text-align: left;">👨‍🏫 Entraîneur</th>
                                    <th style="text-align: left;">📝 Description</th>
                                    <th style="text-align: left;">📅 Séances</th>
                                    <th style="text-align: center; width: 220px;">⚙️ Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entrainements as $entrainement)
                                    <tr>
                                        <td>
                                            <div style="font-weight: 600; color: var(--brand-primary); font-size: 1.1rem;">
                                                {{ $entrainement->titre }}
                                            </div>
                                            <div style="font-size: 0.875rem; color: var(--text-muted); margin-top: 2px;">
                                                Créé le {{ $entrainement->created_at->format('d/m/Y') }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($entrainement->entraineur)
                                                <div style="display: flex; align-items: center; gap: 8px;">
                                                    <span style="background: rgba(124, 58, 237, 0.1); color: var(--brand-primary); padding: 4px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: 600;">
                                                        👤
                                                    </span>
                                                    <div>
                                                        <div style="font-weight: 500;">
                                                            {{ $entrainement->entraineur->prenom }} {{ $entrainement->entraineur->nom }}
                                                        </div>
                                                        <div style="font-size: 0.75rem; color: var(--text-muted);">
                                                            {{ $entrainement->entraineur->role ?? 'Entraîneur' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span style="color: var(--text-muted); font-style: italic; display: flex; align-items: center; gap: 6px;">
                                                    <span>❓</span> Non assigné
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div style="color: var(--text-secondary); line-height: 1.4;">
                                                {{ Str::limit($entrainement->description ?? 'Aucune description disponible', 80) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 6px;">
                                                <span style="background: var(--info-light); color: var(--info); padding: 4px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: 600;">
                                                    📅 {{ $entrainement->seances_count ?? 0 }}
                                                </span>
                                                <span style="font-size: 0.75rem; color: var(--text-muted);">
                                                    séance{{ ($entrainement->seances_count ?? 0) > 1 ? 's' : '' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div style="display: flex; gap: 6px; justify-content: center; flex-wrap: wrap;">
                                                <a href="{{ route('entrainements.show', $entrainement) }}" class="button button-secondary" style="padding: 6px 10px; font-size: 0.75rem;">
                                                    👁️ Voir
                                                </a>
                                                <a href="{{ route('entrainements.edit', $entrainement) }}" class="button" style="background: var(--warning); color: white; padding: 6px 10px; font-size: 0.75rem;">
                                                    ✏️ Modifier
                                                </a>
                                                <form method="POST" action="{{ route('entrainements.destroy', $entrainement) }}" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce programme d\'entraînement ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="button" style="background: var(--danger); color: white; padding: 6px 10px; font-size: 0.75rem;">
                                                        🗑️ Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pagination --}}
                @if($entrainements->hasPages())
                    <div style="padding: 1.5rem; border-top: 1px solid var(--border); background: var(--background-subtle);">
                        {{ $entrainements->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-icon">🏊‍♀️</div>
                    <h3 class="empty-title">Aucun programme d'entraînement</h3>
                    <p class="empty-description">Commencez par créer votre premier programme d'entraînement pour structurer les activités du club.</p>
                    <a href="{{ route('entrainements.create') }}" class="button button-primary" style="margin-top: 1rem;">
                        <span>🏊‍♀️</span>
                        Créer un programme
                    </a>
                </div>
            @endif
        </div>

        {{-- Statistiques rapides --}}
        @if($entrainements->count() > 0)
            <div class="grid md:grid-cols-3" style="gap: 1.5rem; margin-top: 2rem;">
                <div class="card" style="text-align: center; padding: 1.5rem;">
                    <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">🏊‍♀️</div>
                    <div style="font-size: 1.5rem; font-weight: 700; color: var(--brand-primary); margin-bottom: 0.25rem;">
                        {{ $entrainements->total() }}
                    </div>
                    <div style="color: var(--text-muted); font-size: 0.875rem;">Programme{{ $entrainements->total() > 1 ? 's' : '' }} d'entraînement</div>
                </div>
                
                <div class="card" style="text-align: center; padding: 1.5rem;">
                    <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">👨‍🏫</div>
                    <div style="font-size: 1.5rem; font-weight: 700; color: var(--success); margin-bottom: 0.25rem;">
                        {{ $entrainements->whereNotNull('entraineur_id')->count() }}
                    </div>
                    <div style="color: var(--text-muted); font-size: 0.875rem;">Programme{{ $entrainements->whereNotNull('entraineur_id')->count() > 1 ? 's' : '' }} assigné{{ $entrainements->whereNotNull('entraineur_id')->count() > 1 ? 's' : '' }}</div>
                </div>
                
                <div class="card" style="text-align: center; padding: 1.5rem;">
                    <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">📅</div>
                    <div style="font-size: 1.5rem; font-weight: 700; color: var(--info); margin-bottom: 0.25rem;">
                        {{ $entrainements->sum('seances_count') ?? 0 }}
                    </div>
                    <div style="color: var(--text-muted); font-size: 0.875rem;">Séance{{ ($entrainements->sum('seances_count') ?? 0) > 1 ? 's' : '' }} planifiée{{ ($entrainements->sum('seances_count') ?? 0) > 1 ? 's' : '' }}</div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
