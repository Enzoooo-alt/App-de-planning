@extends('layouts.app-v2')

@section('title', 'Gestion des paiements')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <!-- Breadcrumb -->
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">Paiements</span>
    </nav>

    <!-- En-tête -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
                💳 Gestion des paiements
            </h1>
            <p style="color: var(--lp-text-muted);">
                Suivi des cotisations et paiements des adhérents
            </p>
        </div>
        <div style="display: flex; gap: 1rem;">
            <a href="{{ route('paiements.dashboard') }}" class="btn btn-secondary">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('paiements.create') }}" class="btn btn-primary">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Enregistrer un paiement
            </a>
        </div>
    </div>

    <!-- Statistiques rapides -->
    <div class="grid md:grid-cols-4 gap-4" style="margin-bottom: 2rem;">
        <div class="card" style="padding: var(--lp-space-lg);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="background: linear-gradient(135deg, #10b981, #059669); color: white; width: 3rem; height: 3rem; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    💰
                </div>
                <div>
                    <div style="font-size: 1.75rem; font-weight: 700; color: var(--lp-navy);">
                        {{ number_format($stats['total'], 2) }}€
                    </div>
                    <div style="color: var(--lp-text-muted); font-size: 0.875rem;">
                        Total encaissé
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="padding: var(--lp-space-lg);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="background: linear-gradient(135deg, var(--lp-navy), var(--lp-teal)); color: white; width: 3rem; height: 3rem; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    📋
                </div>
                <div>
                    <div style="font-size: 1.75rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $stats['total_paiements'] }}
                    </div>
                    <div style="color: var(--lp-text-muted); font-size: 0.875rem;">
                        Total paiements
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="padding: var(--lp-space-lg);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="background: linear-gradient(135deg, #10b981, #059669); color: white; width: 3rem; height: 3rem; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    ✓
                </div>
                <div>
                    <div style="font-size: 1.75rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $stats['valides'] }}
                    </div>
                    <div style="color: var(--lp-text-muted); font-size: 0.875rem;">
                        Validés
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="padding: var(--lp-space-lg);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; width: 3rem; height: 3rem; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    ⏳
                </div>
                <div>
                    <div style="font-size: 1.75rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $stats['en_attente'] }}
                    </div>
                    <div style="color: var(--lp-text-muted); font-size: 0.875rem;">
                        En attente
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des paiements -->
    <div class="card">
        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 20%;">Adhérent</th>
                        <th style="width: 15%;">Type</th>
                        <th style="width: 10%;">Montant</th>
                        <th style="width: 12%;">Méthode</th>
                        <th style="width: 12%;">Statut</th>
                        <th style="width: 13%;">Date</th>
                        <th style="width: 10%;">Saison</th>
                        <th style="width: 8%; text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paiements as $paiement)
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: var(--lp-navy);">
                                    {{ $paiement->adherent->prenom }} {{ $paiement->adherent->nom }}
                                </div>
                            </td>
                            <td>
                                <span style="font-size: 0.875rem;">
                                    {!! $paiement->type_label !!}
                                </span>
                            </td>
                            <td>
                                <div style="font-weight: 700; color: var(--lp-teal); font-size: 1.125rem;">
                                    {{ number_format($paiement->montant, 2) }}€
                                </div>
                            </td>
                            <td>
                                <span style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                    {{ ucfirst($paiement->methode) }}
                                </span>
                            </td>
                            <td>{!! $paiement->statut_badge !!}</td>
                            <td>
                                <div style="font-size: 0.875rem;">
                                    {{ $paiement->date_paiement->format('d/m/Y') }}
                                </div>
                            </td>
                            <td>
                                <span style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                    {{ $paiement->saison ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <a href="{{ route('paiements.show', $paiement) }}" 
                                       class="btn btn-sm btn-secondary"
                                       title="Voir">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </a>
                                    <a href="{{ route('paiements.edit', $paiement) }}" 
                                       class="btn btn-sm btn-primary"
                                       title="Modifier">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 3rem; color: var(--lp-text-muted);">
                                <div style="font-size: 3rem; margin-bottom: 1rem;">💳</div>
                                <div style="font-weight: 600;">Aucun paiement enregistré</div>
                                <div>Commencez par enregistrer un premier paiement</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($paiements->hasPages())
            <div style="padding: var(--lp-space-lg); border-top: 1px solid var(--lp-border);">
                {{ $paiements->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
