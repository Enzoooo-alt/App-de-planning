@extends('layouts.app-v2')

@section('title', 'Statistiques de présences')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <!-- Breadcrumb -->
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">Présences</span>
    </nav>

    <!-- En-tête -->
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
            📊 Statistiques de présences
        </h1>
        <p style="color: var(--lp-text-muted);">
            Vue d'ensemble de l'assiduité des adhérents du club
        </p>
    </div>

    <!-- Liste des adhérents -->
    <div class="card">
        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 30%;">Adhérent</th>
                        <th style="width: 15%; text-align: center;">Total séances</th>
                        <th style="width: 15%; text-align: center;">Présents</th>
                        <th style="width: 15%; text-align: center;">Absents</th>
                        <th style="width: 15%; text-align: center;">Taux de présence</th>
                        <th style="width: 10%; text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($adherents as $adherent)
                        <tr>
                            <!-- Nom de l'adhérent -->
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div class="avatar">
                                        {{ strtoupper(substr($adherent->prenom, 0, 1)) }}{{ strtoupper(substr($adherent->nom, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 600; color: var(--lp-navy);">
                                            {{ $adherent->prenom }} {{ $adherent->nom }}
                                        </div>
                                        @if($adherent->niveau)
                                            <div style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                                {{ ucfirst($adherent->niveau) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Total séances -->
                            <td style="text-align: center;">
                                <div style="font-size: 1.25rem; font-weight: 700; color: var(--lp-navy);">
                                    {{ $adherent->total_presences }}
                                </div>
                            </td>

                            <!-- Présents -->
                            <td style="text-align: center;">
                                <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                                    <span style="color: #10b981; font-size: 1.125rem; font-weight: 700;">
                                        {{ $adherent->total_presents }}
                                    </span>
                                </div>
                            </td>

                            <!-- Absents -->
                            <td style="text-align: center;">
                                <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                                    <span style="color: #ef4444; font-size: 1.125rem; font-weight: 700;">
                                        {{ $adherent->total_absents }}
                                    </span>
                                </div>
                            </td>

                            <!-- Taux de présence -->
                            <td style="text-align: center;">
                                <div style="position: relative;">
                                    <!-- Barre de progression -->
                                    <div style="height: 8px; background: var(--lp-border); border-radius: 10px; overflow: hidden; margin-bottom: 0.5rem;">
                                        <div style="height: 100%; background: {{ $adherent->taux_presence >= 75 ? '#10b981' : ($adherent->taux_presence >= 50 ? '#f59e0b' : '#ef4444') }}; width: {{ $adherent->taux_presence }}%; transition: width 0.3s;"></div>
                                    </div>
                                    
                                    <!-- Pourcentage -->
                                    <div style="font-size: 1.125rem; font-weight: 700; color: {{ $adherent->taux_presence >= 75 ? '#10b981' : ($adherent->taux_presence >= 50 ? '#f59e0b' : '#ef4444') }};">
                                        {{ $adherent->taux_presence }}%
                                    </div>
                                    
                                    <!-- Badge qualité -->
                                    @if($adherent->taux_presence >= 90)
                                        <div style="font-size: 0.75rem; color: #10b981;">Excellent</div>
                                    @elseif($adherent->taux_presence >= 75)
                                        <div style="font-size: 0.75rem; color: #10b981;">Très bien</div>
                                    @elseif($adherent->taux_presence >= 50)
                                        <div style="font-size: 0.75rem; color: #f59e0b;">À améliorer</div>
                                    @else
                                        <div style="font-size: 0.75rem; color: #ef4444;">Insuffisant</div>
                                    @endif
                                </div>
                            </td>

                            <!-- Actions -->
                            <td style="text-align: center;">
                                <a href="{{ route('presences.statistics', $adherent) }}" 
                                   class="btn btn-sm btn-primary"
                                   title="Voir le détail">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    Détails
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem; color: var(--lp-text-muted);">
                                <div style="font-size: 3rem; margin-bottom: 1rem;">📊</div>
                                <div style="font-weight: 600;">Aucune donnée de présence</div>
                                <div>Les statistiques apparaîtront une fois que des présences seront enregistrées.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Légende -->
    <div class="card" style="margin-top: 2rem; background: var(--lp-bg-ocean);">
        <div style="padding: var(--lp-space-lg);">
            <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 1rem;">
                📖 Légende
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 2.5rem; height: 2.5rem; background: #10b981; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">
                        ≥75
                    </div>
                    <div>
                        <div style="font-weight: 600; color: var(--lp-navy);">Très bien</div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted);">Assiduité excellente</div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 2.5rem; height: 2.5rem; background: #f59e0b; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">
                        ≥50
                    </div>
                    <div>
                        <div style="font-weight: 600; color: var(--lp-navy);">À améliorer</div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted);">Présence irrégulière</div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 2.5rem; height: 2.5rem; background: #ef4444; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">
                        &lt;50
                    </div>
                    <div>
                        <div style="font-weight: 600; color: var(--lp-navy);">Insuffisant</div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted);">Absences fréquentes</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
