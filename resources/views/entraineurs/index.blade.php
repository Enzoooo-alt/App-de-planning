{{-- 
    Liste des Entraîneurs - Lyon Palme
    Vue pour l'affichage et la gestion du personnel d'encadrement
    Design: Framework CSS Lyon-Palme violet professionnel
--}}
@extends('layouts.app')

@section('title', 'Entraîneurs - Lyon Palme')

@section('content')
<section style="padding: 2rem 0;">
    <div class="container">
        
        {{-- En-tête de la page entraîneurs --}}
        <div class="profile-section mb-6">
            <div class="profile-header">
                <h1 class="h1" style="display: flex; align-items: center; margin: 0;">
                    <span style="margin-right: 0.75rem; font-size: 2rem;">👨‍🏫</span>
                    Équipe d'Entraîneurs
                </h1>
                <p style="margin: 0.5rem 0 0; opacity: 0.95; font-size: 1.1rem;">
                    Gestion du personnel d'encadrement et des spécialités
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
                
                @if(auth()->check() && auth()->user()->hasAnyRole(['president', 'responsable_planning']))
                <a href="{{ route('entraineurs.create') }}" class="button button-primary">
                    <span>➕</span>
                    Nouvel Entraîneur
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

        {{-- Statistiques de l'équipe --}}
        <div class="grid md:grid-cols-4" style="gap: 1.5rem; margin-bottom: 2rem;">
            <div class="card" style="text-align: center; padding: 1.5rem;">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">👨‍🏫</div>
                <div style="font-size: 1.5rem; font-weight: 700; color: var(--brand-primary); margin-bottom: 0.25rem;">
                    {{ $entraineurs->total() }}
                </div>
                <div style="color: var(--text-muted); font-size: 0.875rem;">Entraîneur{{ $entraineurs->total() > 1 ? 's' : '' }} total{{ $entraineurs->total() > 1 ? 'aux' : '' }}</div>
            </div>
            
            <div class="card" style="text-align: center; padding: 1.5rem;">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">🏊‍♀️</div>
                <div style="font-size: 1.5rem; font-weight: 700; color: var(--success); margin-bottom: 0.25rem;">
                    {{ $entraineurs->sum('entrainements_count') ?? 0 }}
                </div>
                <div style="color: var(--text-muted); font-size: 0.875rem;">Programme{{ ($entraineurs->sum('entrainements_count') ?? 0) > 1 ? 's' : '' }} assigné{{ ($entraineurs->sum('entrainements_count') ?? 0) > 1 ? 's' : '' }}</div>
            </div>
            
            <div class="card" style="text-align: center; padding: 1.5rem;">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">⭐</div>
                <div style="font-size: 1.5rem; font-weight: 700; color: var(--info); margin-bottom: 0.25rem;">
                    {{ $entraineurs->whereNotNull('role')->count() }}
                </div>
                <div style="color: var(--text-muted); font-size: 0.875rem;">Spécialité{{ $entraineurs->whereNotNull('role')->count() > 1 ? 's' : '' }} définie{{ $entraineurs->whereNotNull('role')->count() > 1 ? 's' : '' }}</div>
            </div>
            
            <div class="card" style="text-align: center; padding: 1.5rem;">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">🔑</div>
                <div style="font-size: 1.5rem; font-weight: 700; color: var(--warning); margin-bottom: 0.25rem;">
                    {{ $entraineurs->whereNotNull('login')->count() }}
                </div>
                <div style="color: var(--text-muted); font-size: 0.875rem;">Accès système</div>
            </div>
        </div>

        {{-- Liste des entraîneurs --}}
        <div class="profile-section">
            @if($entraineurs->count() > 0)
                <div class="profile-header">
                    <h2 class="h3" style="margin: 0; display: flex; align-items: center;">
                        <span style="margin-right: 0.5rem; font-size: 1.25rem;">📋</span>
                        Équipe d'Encadrement ({{ $entraineurs->total() }} entraîneur{{ $entraineurs->total() > 1 ? 's' : '' }})
                    </h2>
                </div>
                
                <div class="profile-content" style="padding: 0;">
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: left;">👨‍🏫 Entraîneur</th>
                                    <th style="text-align: left;">⭐ Spécialité/Rôle</th>
                                    <th style="text-align: left;">🏊‍♀️ Programmes</th>
                                    <th style="text-align: left;">🔑 Accès Système</th>
                                    <th style="text-align: center; width: 200px;">⚙️ Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entraineurs as $entraineur)
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 12px;">
                                                <div style="width: 45px; height: 45px; background: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-secondary) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; color: white;">
                                                    👨‍🏫
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600; color: var(--brand-primary); font-size: 1.1rem;">
                                                        {{ $entraineur->prenom }} {{ $entraineur->nom }}
                                                    </div>
                                                    <div style="font-size: 0.875rem; color: var(--text-muted);">
                                                        Membre depuis {{ $entraineur->created_at->format('Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($entraineur->role)
                                                <span style="background: var(--warning-light); color: var(--warning); padding: 6px 12px; border-radius: 16px; font-size: 0.875rem; font-weight: 600; display: inline-block;">
                                                    ⭐ {{ $entraineur->role }}
                                                </span>
                                            @else
                                                <span style="color: var(--text-muted); font-style: italic;">
                                                    Spécialité non définie
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 8px;">
                                                @if($entraineur->entrainements_count > 0)
                                                    <span style="background: var(--success-light); color: var(--success); padding: 4px 10px; border-radius: 12px; font-size: 0.75rem; font-weight: 600;">
                                                        🏊‍♀️ {{ $entraineur->entrainements_count }}
                                                    </span>
                                                    <span style="font-size: 0.75rem; color: var(--text-muted);">
                                                        programme{{ $entraineur->entrainements_count > 1 ? 's' : '' }}
                                                    </span>
                                                @else
                                                    <span style="color: var(--text-muted); font-style: italic; font-size: 0.875rem;">
                                                        Aucun programme assigné
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if($entraineur->login)
                                                <div style="display: flex; align-items: center; gap: 6px;">
                                                    <span style="background: var(--info-light); color: var(--info); padding: 4px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: 600;">
                                                        🔑 Actif
                                                    </span>
                                                    @if(auth()->check() && auth()->user()->hasAnyRole(['president', 'responsable_planning']))
                                                    <div style="font-size: 0.75rem; color: var(--text-muted);">
                                                        {{ $entraineur->login }}
                                                    </div>
                                                    @endif
                                                </div>
                                            @else
                                                <span style="color: var(--text-muted); font-style: italic; font-size: 0.875rem;">
                                                    🔒 Pas d'accès
                                                </span>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            <div style="display: flex; gap: 6px; justify-content: center; flex-wrap: wrap;">
                                                <a href="{{ route('entraineurs.show', $entraineur) }}" class="button button-secondary" style="padding: 6px 10px; font-size: 0.75rem;">
                                                    👁️ Voir
                                                </a>
                                                @if(auth()->check() && auth()->user()->hasAnyRole(['president', 'responsable_planning']))
                                                <a href="{{ route('entraineurs.edit', $entraineur) }}" class="button" style="background: var(--warning); color: white; padding: 6px 10px; font-size: 0.75rem;">
                                                    ✏️ Modifier
                                                </a>
                                                <form method="POST" action="{{ route('entraineurs.destroy', $entraineur) }}" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet entraîneur ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="button" style="background: var(--danger); color: white; padding: 6px 10px; font-size: 0.75rem;">
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
                @if($entraineurs->hasPages())
                    <div style="padding: 1.5rem; border-top: 1px solid var(--border); background: var(--background-subtle);">
                        {{ $entraineurs->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-icon">👨‍🏫</div>
                    <h3 class="empty-title">Aucun entraîneur enregistré</h3>
                    <p class="empty-description">Commencez par ajouter les premiers entraîneurs pour encadrer les activités du club.</p>
                    <a href="{{ route('entraineurs.create') }}" class="button button-primary" style="margin-top: 1rem;">
                        <span>👨‍🏫</span>
                        Ajouter un entraîneur
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
