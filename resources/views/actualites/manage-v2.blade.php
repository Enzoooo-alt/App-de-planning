@extends('layouts.app-v2')

@section('title', 'Gérer les actualités')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <!-- Breadcrumb -->
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <a href="{{ route('actualites.index') }}" style="color: var(--lp-teal); text-decoration: none;">Actualités</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">Gestion</span>
    </nav>

    <!-- En-tête -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
                Gérer les actualités
            </h1>
            <p style="color: var(--lp-text-muted);">
                Vue d'ensemble de toutes les actualités (publiées et brouillons)
            </p>
        </div>
        <a href="{{ route('actualites.create') }}" class="btn btn-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Nouvelle actualité
        </a>
    </div>

    <!-- Statistiques -->
    <div class="grid md:grid-cols-4 gap-4" style="margin-bottom: 2rem;">
        <!-- Total -->
        <div class="card" style="padding: var(--lp-space-lg);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="background: linear-gradient(135deg, var(--lp-navy), var(--lp-teal)); color: white; width: 3rem; height: 3rem; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    📰
                </div>
                <div>
                    <div style="font-size: 1.75rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $actualites->total() }}
                    </div>
                    <div style="color: var(--lp-text-muted); font-size: 0.875rem;">
                        Total
                    </div>
                </div>
            </div>
        </div>

        <!-- Publiées -->
        <div class="card" style="padding: var(--lp-space-lg);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="background: linear-gradient(135deg, #10b981, #059669); color: white; width: 3rem; height: 3rem; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    ✅
                </div>
                <div>
                    <div style="font-size: 1.75rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $actualites->where('statut', 'publie')->count() }}
                    </div>
                    <div style="color: var(--lp-text-muted); font-size: 0.875rem;">
                        Publiées
                    </div>
                </div>
            </div>
        </div>

        <!-- Brouillons -->
        <div class="card" style="padding: var(--lp-space-lg);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; width: 3rem; height: 3rem; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    📝
                </div>
                <div>
                    <div style="font-size: 1.75rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $actualites->where('statut', 'brouillon')->count() }}
                    </div>
                    <div style="color: var(--lp-text-muted); font-size: 0.875rem;">
                        Brouillons
                    </div>
                </div>
            </div>
        </div>

        <!-- Épinglées -->
        <div class="card" style="padding: var(--lp-space-lg);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; width: 3rem; height: 3rem; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    📌
                </div>
                <div>
                    <div style="font-size: 1.75rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $actualites->where('epingle', true)->count() }}
                    </div>
                    <div style="color: var(--lp-text-muted); font-size: 0.875rem;">
                        Épinglées
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des actualités -->
    <div class="card">
        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 40%;">Titre</th>
                        <th style="width: 15%;">Catégorie</th>
                        <th style="width: 12%;">Statut</th>
                        <th style="width: 15%;">Auteur</th>
                        <th style="width: 12%;">Date</th>
                        <th style="width: 6%; text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($actualites as $actualite)
                        <tr>
                            <!-- Titre -->
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    @if($actualite->epingle)
                                        <span style="font-size: 1.25rem;">📌</span>
                                    @endif
                                    <div>
                                        <a href="{{ route('actualites.show', $actualite) }}" 
                                           style="font-weight: 600; color: var(--lp-navy); text-decoration: none;"
                                           onmouseover="this.style.color='var(--lp-teal)'"
                                           onmouseout="this.style.color='var(--lp-navy)'">
                                            {{ Str::limit($actualite->titre, 60) }}
                                        </a>
                                        @if($actualite->image)
                                            <span style="font-size: 0.75rem; color: var(--lp-text-muted);">🖼️ Image</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Catégorie -->
                            <td>
                                <span class="badge" style="background-color: {{ $actualite->category_badge_color }};">
                                    {{ $actualite->category_label }}
                                </span>
                            </td>

                            <!-- Statut -->
                            <td>
                                @if($actualite->statut === 'publie')
                                    <span class="badge badge-success">✅ Publié</span>
                                @else
                                    <span class="badge badge-warning">📝 Brouillon</span>
                                @endif
                            </td>

                            <!-- Auteur -->
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    <div class="avatar-sm">
                                        {{ strtoupper(substr($actualite->author->first_name ?? $actualite->author->name, 0, 1)) }}{{ strtoupper(substr($actualite->author->last_name ?? '', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-size: 0.875rem; font-weight: 600; color: var(--lp-navy);">
                                            {{ $actualite->author->first_name ?? $actualite->author->name }} {{ $actualite->author->last_name ?? '' }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Date -->
                            <td>
                                <div style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                    {{ $actualite->publie_le ? $actualite->publie_le->format('d/m/Y') : $actualite->created_at->format('d/m/Y') }}
                                </div>
                                <div style="font-size: 0.75rem; color: var(--lp-text-muted);">
                                    {{ $actualite->publie_le ? $actualite->publie_le->format('H:i') : $actualite->created_at->format('H:i') }}
                                </div>
                            </td>

                            <!-- Actions -->
                            <td>
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <!-- Voir -->
                                    <a href="{{ route('actualites.show', $actualite) }}" 
                                       class="btn btn-sm btn-secondary"
                                       title="Voir">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </a>

                                    <!-- Modifier -->
                                    <a href="{{ route('actualites.edit', $actualite) }}" 
                                       class="btn btn-sm btn-primary"
                                       title="Modifier">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>

                                    <!-- Supprimer -->
                                    <form method="POST" action="{{ route('actualites.destroy', $actualite) }}" style="display: inline;"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette actualité ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem; color: var(--lp-text-muted);">
                                <div style="font-size: 3rem; margin-bottom: 1rem;">📰</div>
                                <div style="font-weight: 600; margin-bottom: 0.5rem;">Aucune actualité</div>
                                <div>Créez votre première actualité pour commencer</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($actualites->hasPages())
            <div style="padding: var(--lp-space-lg); border-top: 1px solid var(--lp-border);">
                {{ $actualites->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
