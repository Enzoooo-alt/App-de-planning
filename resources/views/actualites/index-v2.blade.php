@extends('layouts.app-v2')

@section('title', 'Actualités du club')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <!-- En-tête -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
                📢 Actualités du club
            </h1>
            <p style="color: var(--lp-text-muted);">
                Suivez toute l'actualité de Lyon Palme
            </p>
        </div>
        @if(auth()->user()->hasAnyRole(['president', 'responsable_planning']))
            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('actualites.manage') }}" class="btn btn-secondary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                    Gérer
                </a>
                <a href="{{ route('actualites.create') }}" class="btn btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Nouvelle actualité
                </a>
            </div>
        @endif
    </div>

    <!-- Messages de feedback -->
    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom: 1.5rem;">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Actualités épinglées -->
    @if($epinglees->count() > 0)
        <div style="margin-bottom: 3rem;">
            <h2 style="font-size: 1.5rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M16 9V4h1c.55 0 1-.45 1-1s-.45-1-1-1H7c-.55 0-1 .45-1 1s.45 1 1 1h1v5c0 1.66-1.34 3-3 3v2h5.97v7l1 1 1-1v-7H19v-2c-1.66 0-3-1.34-3-3z"></path>
                </svg>
                À la une
            </h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($epinglees as $actualite)
                    <a href="{{ route('actualites.show', $actualite) }}" class="card" style="text-decoration: none; transition: all var(--lp-transition-normal); overflow: hidden;"
                       onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--lp-shadow-lg)'"
                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
                        @if($actualite->image)
                            <div style="height: 200px; overflow: hidden;">
                                <img src="{{ Storage::url($actualite->image) }}" alt="{{ $actualite->titre }}" 
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        @else
                            <div style="height: 200px; background: linear-gradient(135deg, var(--lp-teal), var(--lp-marine)); display: flex; align-items: center; justify-content: center;">
                                <svg width="64" height="64" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                </svg>
                            </div>
                        @endif
                        <div style="padding: 1.5rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                                <span class="badge badge-{{ $actualite->category_badge_color }}">
                                    {{ $actualite->category_label }}
                                </span>
                                <span style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                    {{ $actualite->publie_le->format('d M Y') }}
                                </span>
                            </div>
                            <h3 style="font-size: 1.25rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.75rem;">
                                {{ $actualite->titre }}
                            </h3>
                            <p style="color: var(--lp-text-muted); font-size: 0.9375rem; line-height: 1.6;">
                                {{ Str::limit(strip_tags($actualite->contenu), 120) }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Toutes les actualités -->
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 1.5rem;">
            Toutes les actualités
        </h2>
        
        @if($actualites->count() > 0)
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($actualites as $actualite)
                    <a href="{{ route('actualites.show', $actualite) }}" class="card" style="text-decoration: none; transition: all var(--lp-transition-normal); overflow: hidden;"
                       onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--lp-shadow-lg)'"
                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
                        @if($actualite->image)
                            <div style="height: 200px; overflow: hidden;">
                                <img src="{{ Storage::url($actualite->image) }}" alt="{{ $actualite->titre }}" 
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        @else
                            <div style="height: 200px; background: linear-gradient(135deg, var(--lp-navy), var(--lp-marine)); display: flex; align-items: center; justify-content: center;">
                                <svg width="48" height="48" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                </svg>
                            </div>
                        @endif
                        <div style="padding: 1.5rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                                <span class="badge badge-{{ $actualite->category_badge_color }}">
                                    {{ $actualite->category_label }}
                                </span>
                                <span style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                    {{ $actualite->publie_le->format('d M Y') }}
                                </span>
                            </div>
                            <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.75rem;">
                                {{ $actualite->titre }}
                            </h3>
                            <p style="color: var(--lp-text-muted); font-size: 0.9375rem; line-height: 1.6;">
                                {{ Str::limit(strip_tags($actualite->contenu), 100) }}
                            </p>
                            <div style="margin-top: 1rem; font-size: 0.875rem; color: var(--lp-text-muted); display: flex; align-items: center; gap: 0.5rem;">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                Par {{ $actualite->user->name }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($actualites->hasPages())
                <div style="margin-top: 2rem;">
                    {{ $actualites->links() }}
                </div>
            @endif
        @else
            <div class="card" style="text-align: center; padding: 4rem 2rem;">
                <svg width="64" height="64" fill="none" stroke="var(--lp-text-muted)" stroke-width="2" viewBox="0 0 24 24" style="margin: 0 auto 1.5rem; opacity: 0.3;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <h3 style="font-size: 1.25rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                    Aucune actualité pour le moment
                </h3>
                <p style="color: var(--lp-text-muted);">
                    Les actualités du club apparaîtront ici
                </p>
            </div>
        @endif
    </div>
</div>
@endsection
