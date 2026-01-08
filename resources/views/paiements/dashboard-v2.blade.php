@extends('layouts.app-v2')

@section('title', 'Dashboard Paiements')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <a href="{{ route('paiements.index') }}" style="color: var(--lp-teal); text-decoration: none;">Paiements</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">Dashboard</span>
    </nav>

    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
            📊 Dashboard des paiements
        </h1>
        <p style="color: var(--lp-text-muted);">
            Vue d'ensemble financière - Saison {{ $saisonActuelle }}
        </p>
    </div>

    <!-- Statistiques principales -->
    <div class="grid md:grid-cols-4 gap-4" style="margin-bottom: 2rem;">
        <div class="card" style="padding: var(--lp-space-lg);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="background: linear-gradient(135deg, #10b981, #059669); color: white; width: 3.5rem; height: 3.5rem; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.75rem;">
                    💰
                </div>
                <div>
                    <div style="font-size: 2rem; font-weight: 700; color: var(--lp-navy);">
                        {{ number_format($stats['total_encaisse'], 0) }}€
                    </div>
                    <div style="color: var(--lp-text-muted); font-size: 0.875rem;">Total encaissé</div>
                </div>
            </div>
        </div>

        <div class="card" style="padding: var(--lp-space-lg);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="background: linear-gradient(135deg, var(--lp-navy), var(--lp-teal)); color: white; width: 3.5rem; height: 3.5rem; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.75rem;">
                    ✓
                </div>
                <div>
                    <div style="font-size: 2rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $stats['cotisations_payees'] }}
                    </div>
                    <div style="color: var(--lp-text-muted); font-size: 0.875rem;">Cotisations payées</div>
                </div>
            </div>
        </div>

        <div class="card" style="padding: var(--lp-space-lg);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; width: 3.5rem; height: 3.5rem; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.75rem;">
                    ⚠️
                </div>
                <div>
                    <div style="font-size: 2rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $stats['cotisations_impayees'] }}
                    </div>
                    <div style="color: var(--lp-text-muted); font-size: 0.875rem;">Impayées</div>
                </div>
            </div>
        </div>

        <div class="card" style="padding: var(--lp-space-lg);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; width: 3.5rem; height: 3.5rem; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.75rem;">
                    ⏳
                </div>
                <div>
                    <div style="font-size: 2rem; font-weight: 700; color: var(--lp-navy);">
                        {{ number_format($stats['en_attente'], 0) }}€
                    </div>
                    <div style="color: var(--lp-text-muted); font-size: 0.875rem;">En attente</div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <!-- Répartition par type -->
        <div class="card">
            <div style="padding: var(--lp-space-lg); border-bottom: 1px solid var(--lp-border);">
                <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--lp-navy);">
                    Répartition par type
                </h2>
            </div>
            <div style="padding: var(--lp-space-lg);">
                @foreach($paiementsParType as $item)
                    <div style="margin-bottom: 1rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span style="font-weight: 600; color: var(--lp-navy);">
                                @if($item->type == 'cotisation_annuelle') 💰 Cotisation annuelle
                                @elseif($item->type == 'stage') 🏊 Stage
                                @elseif($item->type == 'competition') 🏆 Compétition
                                @elseif($item->type == 'equipement') 👕 Équipement
                                @else 📋 Autre
                                @endif
                            </span>
                            <span style="font-weight: 700; color: var(--lp-teal);">
                                {{ number_format($item->total, 2) }}€
                            </span>
                        </div>
                        @php
                            $percentage = $stats['total_encaisse'] > 0 ? ($item->total / $stats['total_encaisse']) * 100 : 0;
                        @endphp
                        <div style="height: 8px; background: var(--lp-border); border-radius: 10px; overflow: hidden;">
                            <div style="height: 100%; background: var(--lp-teal); width: {{ $percentage }}%;"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Paiements récents -->
        <div class="card">
            <div style="padding: var(--lp-space-lg); border-bottom: 1px solid var(--lp-border);">
                <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--lp-navy);">
                    Paiements récents
                </h2>
            </div>
            <div style="max-height: 400px; overflow-y: auto;">
                @foreach($paiementsRecents as $paiement)
                    <div style="padding: var(--lp-space-lg); border-bottom: 1px solid var(--lp-border);">
                        <div style="display: flex; justify-content: space-between; align-items: start;">
                            <div>
                                <div style="font-weight: 600; color: var(--lp-navy);">
                                    {{ $paiement->adherent->prenom }} {{ $paiement->adherent->nom }}
                                </div>
                                <div style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                    {{ $paiement->date_paiement->format('d/m/Y') }}
                                </div>
                            </div>
                            <div style="text-align: right;">
                                <div style="font-weight: 700; color: var(--lp-teal); font-size: 1.125rem;">
                                    {{ number_format($paiement->montant, 2) }}€
                                </div>
                                {!! $paiement->statut_badge !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
