@extends('layouts.app-v2')

@section('title', 'Statistiques de présence')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <a href="{{ route('presences.index') }}" style="color: var(--lp-teal); text-decoration: none;">Présences</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">Statistiques de {{ $adherent->prenom }}</span>
    </nav>

    <!-- En-tête adhérent -->
    <div class="card" style="margin-bottom: 2rem;">
        <div style="padding: var(--lp-space-lg); display: flex; align-items: center; gap: 1.5rem;">
            <div style="width: 5rem; height: 5rem; background: linear-gradient(135deg, var(--lp-navy), var(--lp-teal)); color: white; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 2rem;">
                {{ substr($adherent->prenom, 0, 1) }}{{ substr($adherent->nom, 0, 1) }}
            </div>
            <div style="flex: 1;">
                <h1 style="font-size: 1.75rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
                    {{ $adherent->prenom }} {{ $adherent->nom }}
                </h1>
                <div style="display: flex; gap: 1.5rem; color: var(--lp-text-muted); font-size: 0.875rem;">
                    <span>{{ $adherent->email }}</span>
                    @if($adherent->telephone)
                        <span>{{ $adherent->telephone }}</span>
                    @endif
                </div>
            </div>
            <a href="{{ route('adherents.show', $adherent) }}" class="btn btn-secondary">
                Voir le profil
            </a>
        </div>
    </div>

    <!-- Statistiques globales -->
    <div class="grid md:grid-cols-4 gap-4" style="margin-bottom: 2rem;">
        <div class="card" style="padding: var(--lp-space-lg);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="background: linear-gradient(135deg, var(--lp-navy), var(--lp-teal)); color: white; width: 3.5rem; height: 3.5rem; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.75rem;">
                    📊
                </div>
                <div>
                    <div style="font-size: 2rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $stats['total'] }}
                    </div>
                    <div style="color: var(--lp-text-muted); font-size: 0.875rem;">Séances</div>
                </div>
            </div>
        </div>

        <div class="card" style="padding: var(--lp-space-lg);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="background: linear-gradient(135deg, #10b981, #059669); color: white; width: 3.5rem; height: 3.5rem; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.75rem;">
                    ✅
                </div>
                <div>
                    <div style="font-size: 2rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $stats['presents'] }}
                    </div>
                    <div style="color: var(--lp-text-muted); font-size: 0.875rem;">Présent(e)</div>
                </div>
            </div>
        </div>

        <div class="card" style="padding: var(--lp-space-lg);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; width: 3.5rem; height: 3.5rem; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.75rem;">
                    ❌
                </div>
                <div>
                    <div style="font-size: 2rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $stats['absents'] }}
                    </div>
                    <div style="color: var(--lp-text-muted); font-size: 0.875rem;">Absent(e)</div>
                </div>
            </div>
        </div>

        <div class="card" style="padding: var(--lp-space-lg);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; width: 3.5rem; height: 3.5rem; border-radius: var(--lp-radius); display: flex; align-items: center; justify-content: center; font-size: 1.75rem;">
                    📝
                </div>
                <div>
                    <div style="font-size: 2rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $stats['excuses'] }}
                    </div>
                    <div style="color: var(--lp-text-muted); font-size: 0.875rem;">Excusé(e)</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Taux de présence -->
    <div class="card" style="margin-bottom: 2rem;">
        <div style="padding: var(--lp-space-lg);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--lp-navy);">
                    Taux de présence
                </h2>
                <div style="font-size: 2.5rem; font-weight: 700; color: var(--lp-teal);">
                    {{ $stats['taux'] }}%
                </div>
            </div>
            <div style="height: 2rem; background: var(--lp-border); border-radius: 1rem; overflow: hidden;">
                <div style="height: 100%; background: linear-gradient(90deg, var(--lp-teal), #10b981); width: {{ $stats['taux'] }}%; transition: width 0.5s ease;"></div>
            </div>
        </div>
    </div>

    <!-- Historique détaillé -->
    <div class="card">
        <div style="padding: var(--lp-space-lg); border-bottom: 1px solid var(--lp-border);">
            <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--lp-navy);">
                Historique des présences
            </h2>
        </div>

        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Séance</th>
                        <th>Entraînement</th>
                        <th>Statut</th>
                        <th>Commentaire</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($presences as $presence)
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: var(--lp-navy);">
                                    {{ $presence->seance->date->format('d/m/Y') }}
                                </div>
                                <div style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                    {{ $presence->seance->date->format('H:i') }}
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('seances.show', $presence->seance) }}" style="color: var(--lp-teal); text-decoration: none; font-weight: 500;">
                                    {{ $presence->seance->titre }}
                                </a>
                            </td>
                            <td>
                                <div style="font-weight: 500; color: var(--lp-navy);">
                                    {{ $presence->seance->entrainement->nom }}
                                </div>
                                <div style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                    {{ $presence->seance->entrainement->niveau }}
                                </div>
                            </td>
                            <td>
                                @if($presence->statut == 'present')
                                    <span class="badge" style="background-color: #10b981; color: white;">
                                        ✅ Présent(e)
                                    </span>
                                @elseif($presence->statut == 'absent')
                                    <span class="badge" style="background-color: #ef4444; color: white;">
                                        ❌ Absent(e)
                                    </span>
                                @elseif($presence->statut == 'excuse')
                                    <span class="badge" style="background-color: #f59e0b; color: white;">
                                        📝 Excusé(e)
                                    </span>
                                @else
                                    <span class="badge" style="background-color: var(--lp-text-muted); color: white;">
                                        ⏳ Non vérifié
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($presence->commentaire)
                                    <div style="max-width: 300px; color: var(--lp-text-muted); font-size: 0.875rem;">
                                        {{ Str::limit($presence->commentaire, 60) }}
                                    </div>
                                @else
                                    <span style="color: var(--lp-text-muted); font-style: italic; font-size: 0.875rem;">
                                        Aucun commentaire
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 3rem; color: var(--lp-text-muted);">
                                <div style="font-size: 3rem; margin-bottom: 1rem;">📋</div>
                                <div style="font-weight: 600;">Aucune présence enregistrée</div>
                                <div style="font-size: 0.875rem; margin-top: 0.5rem;">
                                    Les présences apparaîtront ici une fois enregistrées
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($presences->hasPages())
            <div style="padding: var(--lp-space-lg); border-top: 1px solid var(--lp-border);">
                {{ $presences->links() }}
            </div>
        @endif
    </div>

    <div style="margin-top: 2rem;">
        <a href="{{ route('presences.index') }}" class="btn btn-secondary">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Retour aux statistiques globales
        </a>
    </div>
</div>
@endsection
