@extends('layouts.app-v2')

@section('title', $actualite->titre)

@section('content')
<div class="container" style="padding: 2rem 0;">
    <!-- Breadcrumb -->
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <a href="{{ route('actualites.index') }}" style="color: var(--lp-teal); text-decoration: none;">Actualités</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">{{ Str::limit($actualite->titre, 50) }}</span>
    </nav>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Contenu principal -->
        <div style="grid-column: span 2;">
            <div class="card">
                <!-- Image -->
                @if($actualite->image)
                    <div style="width: 100%; height: 400px; background-image: url('{{ Storage::url($actualite->image) }}'); background-size: cover; background-position: center; border-radius: var(--lp-radius) var(--lp-radius) 0 0;"></div>
                @endif

                <div style="padding: 2rem;">
                    <!-- Catégorie et date -->
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                        <span class="badge badge-{{ $actualite->category_badge_color }}" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            {{ $actualite->category_label }}
                        </span>
                        <span style="color: var(--lp-text-muted);">
                            {{ $actualite->publie_le->format('d F Y à H:i') }}
                        </span>
                    </div>

                    <!-- Titre -->
                    <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 1rem; line-height: 1.2;">
                        {{ $actualite->titre }}
                    </h1>

                    <!-- Auteur -->
                    <div style="display: flex; align-items: center; gap: 0.75rem; padding-bottom: 1.5rem; margin-bottom: 1.5rem; border-bottom: 2px solid var(--lp-border);">
                        <div style="width: 2.5rem; height: 2.5rem; border-radius: 50%; background: linear-gradient(135deg, var(--lp-teal), var(--lp-marine)); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                            {{ strtoupper(substr($actualite->user->name, 0, 2)) }}
                        </div>
                        <div>
                            <div style="font-weight: 600; color: var(--lp-navy);">
                                {{ $actualite->user->first_name ?? $actualite->user->name }}
                                {{ $actualite->user->last_name ?? '' }}
                            </div>
                            <div style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                {{ $actualite->user->role ? ucfirst(str_replace('_', ' ', $actualite->user->role->nom_role)) : '' }}
                            </div>
                        </div>
                    </div>

                    <!-- Contenu -->
                    <div style="color: var(--lp-text); font-size: 1.125rem; line-height: 1.8;">
                        {!! nl2br(e($actualite->contenu)) !!}
                    </div>

                    <!-- Actions admin -->
                    @if(auth()->user()->hasAnyRole(['president', 'responsable_planning']))
                        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--lp-border); display: flex; gap: 0.75rem;">
                            <a href="{{ route('actualites.edit', $actualite) }}" class="btn btn-secondary">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Modifier
                            </a>
                            <form method="POST" action="{{ route('actualites.destroy', $actualite) }}" 
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette actualité ?')">
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
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Actualités similaires -->
            @if($relatedActualites->count() > 0)
                <div class="card" style="margin-bottom: 1.5rem;">
                    <div style="padding: 1.5rem; border-bottom: 1px solid var(--lp-border);">
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin: 0;">
                            Actualités similaires
                        </h3>
                    </div>
                    <div style="padding: 1rem;">
                        @foreach($relatedActualites as $related)
                            <a href="{{ route('actualites.show', $related) }}" 
                               style="display: block; padding: 1rem; border-radius: var(--lp-radius); text-decoration: none; transition: all var(--lp-transition-fast); margin-bottom: 0.5rem;"
                               onmouseover="this.style.background='var(--lp-bg-ocean)'"
                               onmouseout="this.style.background='transparent'">
                                <div style="font-weight: 600; color: var(--lp-navy); margin-bottom: 0.25rem;">
                                    {{ Str::limit($related->titre, 60) }}
                                </div>
                                <div style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                    {{ $related->publie_le->format('d/m/Y') }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Retour -->
            <div class="card">
                <a href="{{ route('actualites.index') }}" class="btn btn-secondary" style="width: 100%;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                    Retour aux actualités
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
