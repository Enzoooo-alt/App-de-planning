@extends('layouts.app-v2')

@section('title', 'Séances d\'Entraînement - Lyon Palme')

@section('content')
<div class="container" style="padding: 2rem 0;">
    
    <!-- En-tête de la page -->
    <div style="margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div>
                <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
                    Séances d'Entraînement
                </h1>
                <p style="color: var(--lp-text-muted); font-size: 1.125rem;">
                    Planning et gestion des créneaux d'entraînement
                </p>
            </div>
            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('dashboard') }}" class="btn btn-outline">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Retour
                </a>
                @can('manage_seances')
                <a href="{{ route('seances.create') }}" class="btn btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Nouvelle Séance
                </a>
                @endcan
            </div>
        </div>

        <!-- Statistiques rapides -->
        <div class="grid md:grid-cols-4 gap-6">
            <div class="card" style="border-left: 4px solid var(--lp-teal);">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-teal) 0%, var(--lp-teal-light) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Total séances</div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                            {{ $seances->total() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="border-left: 4px solid var(--lp-success);">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-success) 0%, #22c55e 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Cette semaine</div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                            {{ $stats['seances_semaine'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="border-left: 4px solid var(--lp-marine);">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-marine) 0%, var(--lp-marine-light) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Ce mois</div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                            {{ $stats['seances_mois'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="border-left: 4px solid var(--lp-navy);">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-navy) 0%, var(--lp-navy-light) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">À venir</div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                            {{ $stats['seances_avenir'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages de feedback -->
    @if (session('success'))
        <div class="alert alert-success" style="margin-bottom: 2rem;">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" style="margin-bottom: 2rem;">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Liste des séances -->
    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="font-size: 1.5rem; font-weight: 600; color: white; margin: 0;">
                Planning des Séances
            </h2>
            <!-- Filtres optionnels -->
            <div style="display: flex; gap: 0.75rem;">
                <select class="form-select" style="background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2); color: white;">
                    <option>Toutes les dates</option>
                    <option>Cette semaine</option>
                    <option>Ce mois</option>
                    <option>À venir</option>
                </select>
            </div>
        </div>
        
        @if($seances->count() > 0)
            <div style="padding: 0;">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date et Heure</th>
                                <th>Programme</th>
                                <th>Entraîneur</th>
                                <th>Lieu</th>
                                <th style="text-align: center;">Statut</th>
                                <th style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($seances as $seance)
                                @php
                                    $isPast = $seance->date_seance < now();
                                    $isToday = $seance->date_seance->isToday();
                                @endphp
                                <tr style="{{ $isPast ? 'opacity: 0.6;' : '' }}">
                                    <td>
                                        <div style="font-weight: 600; color: var(--lp-navy); font-size: 1.0625rem;">
                                            {{ $seance->date_seance->format('d/m/Y') }}
                                        </div>
                                        <div style="color: var(--lp-text-muted); font-size: 0.9375rem; margin-top: 0.25rem;">
                                            {{ $seance->date_seance->format('l') }} • {{ $seance->heure_debut }} - {{ $seance->heure_fin }}
                                        </div>
                                        @if($isToday)
                                            <span class="badge badge-warning" style="margin-top: 0.25rem;">
                                                Aujourd'hui
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="font-weight: 500; color: var(--lp-navy);">
                                            {{ $seance->entrainement->titre ?? 'Non assigné' }}
                                        </div>
                                        @if($seance->entrainement && $seance->entrainement->niveau)
                                            <span class="badge badge-marine" style="margin-top: 0.25rem;">
                                                {{ ucfirst($seance->entrainement->niveau) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <div style="width: 2rem; height: 2rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <svg width="16" height="16" fill="none" stroke="var(--lp-marine)" stroke-width="2" viewBox="0 0 24 24">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                            </div>
                                            <div style="font-weight: 500; color: var(--lp-navy);">
                                                {{ $seance->entrainement->entraineur->user->name ?? 'Non assigné' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="color: var(--lp-text-secondary);">
                                            {{ $seance->lieu ?? 'À définir' }}
                                        </div>
                                    </td>
                                    <td style="text-align: center;">
                                        @if($isPast)
                                            <span class="badge badge-secondary">Terminée</span>
                                        @elseif($isToday)
                                            <span class="badge badge-warning">En cours</span>
                                        @else
                                            <span class="badge badge-success">Programmée</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                            <a href="{{ route('seances.show', $seance->id) }}" class="btn btn-sm btn-outline" title="Voir les détails">
                                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                                Voir
                                            </a>
                                            @can('manage_seances')
                                                <a href="{{ route('seances.edit', $seance->id) }}" class="btn btn-sm btn-marine" title="Modifier">
                                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                    </svg>
                                                    Modifier
                                                </a>
                                                <form action="{{ route('seances.destroy', $seance->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette séance ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                        </svg>
                                                        Supprimer
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($seances->hasPages())
                    <div style="padding: var(--lp-space-lg); border-top: 1px solid var(--lp-border);">
                        {{ $seances->links() }}
                    </div>
                @endif
            </div>
        @else
            <div style="padding: var(--lp-space-lg);">
                <div style="text-align: center; padding: 3rem 1.5rem;">
                    <div style="width: 5rem; height: 5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <svg width="40" height="40" fill="none" stroke="var(--lp-teal)" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.75rem;">
                        Aucune séance programmée
                    </h3>
                    <p style="color: var(--lp-text-muted); margin-bottom: 2rem; font-size: 1.0625rem;">
                        Commencez par planifier votre première séance d'entraînement.
                    </p>
                    @can('manage_seances')
                        <a href="{{ route('seances.create') }}" class="btn btn-primary">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Planifier une séance
                        </a>
                    @endcan
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
