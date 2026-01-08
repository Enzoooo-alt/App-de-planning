@extends('layouts.app-v2')

@section('title', 'Bibliothèque de documents')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">Documents</span>
    </nav>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
                📚 Bibliothèque de documents
            </h1>
            <p style="color: var(--lp-text-muted);">
                Accédez aux documents partagés du club
            </p>
        </div>
        @if(auth()->user()->hasAnyRole(['president', 'responsable_planning', 'entraineur']))
            <a href="{{ route('documents.create') }}" class="btn btn-primary">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="12" y1="18" x2="12" y2="12"></line>
                    <line x1="9" y1="15" x2="15" y2="15"></line>
                </svg>
                Ajouter un document
            </a>
        @endif
    </div>

    <!-- Filtres -->
    <div class="card" style="margin-bottom: 2rem; padding: var(--lp-space-lg);">
        <form method="GET" action="{{ route('documents.index') }}" style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: end;">
            <div style="flex: 1; min-width: 200px;">
                <label class="form-label">Catégorie</label>
                <select name="categorie" class="form-select">
                    <option value="">Toutes les catégories</option>
                    <option value="reglement" {{ request('categorie') == 'reglement' ? 'selected' : '' }}>📋 Règlements</option>
                    <option value="technique" {{ request('categorie') == 'technique' ? 'selected' : '' }}>🏊 Technique</option>
                    <option value="administratif" {{ request('categorie') == 'administratif' ? 'selected' : '' }}>📄 Administratif</option>
                    <option value="autre" {{ request('categorie') == 'autre' ? 'selected' : '' }}>📁 Autre</option>
                </select>
            </div>
            <div style="flex: 2; min-width: 300px;">
                <label class="form-label">Rechercher</label>
                <input type="text" name="search" class="form-input" placeholder="Titre ou description..." value="{{ request('search') }}">
            </div>
            <button type="submit" class="btn btn-primary">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                Rechercher
            </button>
        </form>
    </div>

    <!-- Liste des documents -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($documents as $document)
            <div class="card" style="padding: var(--lp-space-lg); display: flex; flex-direction: column;">
                <div style="flex: 1;">
                    <div style="display: flex; align-items: start; gap: 1rem; margin-bottom: 1rem;">
                        <div style="flex-shrink: 0; width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-navy), var(--lp-teal)); color: white; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                            📄
                        </div>
                        <div style="flex: 1; min-width: 0;">
                            <h3 style="font-weight: 700; color: var(--lp-navy); margin-bottom: 0.25rem; word-break: break-word;">
                                {{ $document->titre }}
                            </h3>
                            <div style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                @if($document->categorie == 'reglement') 📋 Règlement
                                @elseif($document->categorie == 'technique') 🏊 Technique
                                @elseif($document->categorie == 'administratif') 📄 Administratif
                                @else 📁 Autre
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($document->description)
                        <p style="color: var(--lp-text-muted); font-size: 0.875rem; margin-bottom: 1rem; line-height: 1.5;">
                            {{ Str::limit($document->description, 100) }}
                        </p>
                    @endif

                    <div style="display: flex; align-items: center; gap: 1rem; font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.25rem;">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                            {{ $document->telechargements }}
                        </div>
                        <div>•</div>
                        <div>{{ $document->created_at->format('d/m/Y') }}</div>
                    </div>

                    <div style="font-size: 0.75rem; color: var(--lp-text-muted);">
                        Ajouté par {{ $document->uploader->name }}
                    </div>
                </div>

                <div style="display: flex; gap: 0.5rem; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--lp-border);">
                    <a href="{{ route('documents.show', $document) }}" class="btn btn-sm btn-secondary" style="flex: 1;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        Voir
                    </a>
                    <a href="{{ route('documents.download', $document) }}" class="btn btn-sm btn-primary" style="flex: 1;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                        Télécharger
                    </a>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: var(--lp-text-muted);">
                <div style="font-size: 3rem; margin-bottom: 1rem;">📚</div>
                <div style="font-weight: 600;">Aucun document disponible</div>
                <div>Les documents apparaîtront ici une fois ajoutés</div>
            </div>
        @endforelse
    </div>

    @if($documents->hasPages())
        <div style="margin-top: 2rem;">
            {{ $documents->links() }}
        </div>
    @endif
</div>
@endsection
