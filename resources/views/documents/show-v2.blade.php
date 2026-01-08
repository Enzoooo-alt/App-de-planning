@extends('layouts.app-v2')

@section('title', $document->titre)

@section('content')
<div class="container" style="padding: 2rem 0;">
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <a href="{{ route('documents.index') }}" style="color: var(--lp-teal); text-decoration: none;">Documents</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">{{ Str::limit($document->titre, 30) }}</span>
    </nav>

    <div class="grid md:grid-cols-3 gap-6">
        <!-- Contenu principal -->
        <div style="grid-column: span 2;">
            <div class="card" style="margin-bottom: 2rem;">
                <div style="padding: var(--lp-space-lg);">
                    <div style="display: flex; align-items: start; gap: 1.5rem; margin-bottom: 2rem;">
                        <div style="flex-shrink: 0; width: 4rem; height: 4rem; background: linear-gradient(135deg, var(--lp-navy), var(--lp-teal)); color: white; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                            📄
                        </div>
                        <div style="flex: 1;">
                            <h1 style="font-size: 1.75rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
                                {{ $document->titre }}
                            </h1>
                            <div style="display: flex; gap: 1rem; flex-wrap: wrap; font-size: 0.875rem; color: var(--lp-text-muted);">
                                <span>
                                    @if($document->categorie == 'reglement') 📋 Règlement
                                    @elseif($document->categorie == 'technique') 🏊 Technique
                                    @elseif($document->categorie == 'administratif') 📄 Administratif
                                    @else 📁 Autre
                                    @endif
                                </span>
                                <span>•</span>
                                <span>{{ $document->telechargements }} téléchargements</span>
                                <span>•</span>
                                <span>Ajouté le {{ $document->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>

                    @if($document->description)
                        <div style="padding: 1.5rem; background: var(--lp-bg-ocean); border-radius: var(--lp-radius); margin-bottom: 2rem;">
                            <h3 style="font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">Description</h3>
                            <p style="color: var(--lp-text-muted); line-height: 1.6;">
                                {{ $document->description }}
                            </p>
                        </div>
                    @endif

                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <a href="{{ route('documents.download', $document) }}" class="btn btn-primary" style="flex: 1;">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                            Télécharger
                        </a>
                        
                        @if(auth()->user()->hasAnyRole(['president', 'responsable_planning']))
                            <form method="POST" action="{{ route('documents.destroy', $document) }}" style="flex: 1;"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="width: 100%;">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                    Supprimer
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <div class="card" style="margin-bottom: 1.5rem;">
                <div style="padding: var(--lp-space-lg);">
                    <h3 style="font-weight: 600; color: var(--lp-navy); margin-bottom: 1rem;">Informations</h3>
                    
                    <div style="margin-bottom: 1rem;">
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Uploadé par</div>
                        <div style="font-weight: 600; color: var(--lp-navy);">{{ $document->uploader->name }}</div>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Visibilité</div>
                        <div style="font-weight: 600; color: var(--lp-navy);">
                            @if($document->visible_par == 'tous') 👥 Tous
                            @elseif($document->visible_par == 'adherents_only') 🏊 Adhérents
                            @elseif($document->visible_par == 'entraineurs_only') 👨‍🏫 Entraîneurs
                            @else 🔒 Administrateurs
                            @endif
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Nom du fichier</div>
                        <div style="font-weight: 600; color: var(--lp-navy); word-break: break-all; font-size: 0.875rem;">
                            {{ basename($document->fichier) }}
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('documents.index') }}" class="btn btn-secondary" style="width: 100%;">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Retour à la liste
            </a>
        </div>
    </div>
</div>
@endsection
