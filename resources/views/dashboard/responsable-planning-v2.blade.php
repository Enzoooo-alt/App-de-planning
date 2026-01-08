@extends('layouts.app-v2')

@section('title', 'Tableau de bord - Responsable Planning')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <!-- En-tête du Dashboard -->
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
            Gestion du planning
        </h1>
        <p style="color: var(--lp-text-muted); font-size: 1.125rem;">
            Responsable planning - {{ Auth::user()->first_name ?? Auth::user()->name }}
        </p>
    </div>

    <!-- Statistiques rapides -->
    <div class="grid md:grid-cols-4 gap-6" style="margin-bottom: 2rem;">
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
                    <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Semaine prochaine</div>
                    <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $data['seances_semaine_prochaine']->count() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="border-left: 4px solid var(--lp-marine);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-marine) 0%, var(--lp-marine-light) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Total entraînements</div>
                    <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $stats['total_entrainements'] ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="border-left: 4px solid var(--lp-warning);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-warning) 0%, #fbbf24 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Sans séance</div>
                    <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $data['entrainements_sans_seance']->count() }}
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('seances.create') }}" class="card" style="border: 2px dashed var(--lp-teal); background: var(--lp-bg-ocean); text-decoration: none; transition: all var(--lp-transition-normal);"
           onmouseover="this.style.background='var(--lp-teal)'; this.querySelectorAll('svg, div').forEach(el => el.style.color='white')"
           onmouseout="this.style.background='var(--lp-bg-ocean)'; this.querySelectorAll('svg, div').forEach(el => el.style.color='')">
            <div style="display: flex; align-items: center; justify-content: center; gap: 0.75rem; height: 100%;">
                <svg width="24" height="24" fill="none" stroke="var(--lp-teal)" stroke-width="2" viewBox="0 0 24 24" style="transition: all var(--lp-transition-fast);">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <div style="color: var(--lp-teal); font-weight: 600; transition: all var(--lp-transition-fast);">
                    Planifier une séance
                </div>
            </div>
        </a>
    </div>

    <!-- Alertes : Entraînements sans séances -->
    @if($data['entrainements_sans_seance']->count() > 0)
    <div class="alert alert-warning" style="margin-bottom: 2rem;">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
            <line x1="12" y1="9" x2="12" y2="13"></line>
            <line x1="12" y1="17" x2="12.01" y2="17"></line>
        </svg>
        <span>
            <strong>{{ $data['entrainements_sans_seance']->count() }} entraînement(s)</strong> n'ont pas de séances programmées.
            <a href="{{ route('entrainements.index') }}" style="text-decoration: underline; font-weight: 600;">Voir la liste</a>
        </span>
    </div>
    @endif

    <!-- Planning de la semaine prochaine -->
    <div class="card" style="margin-bottom: 2rem;">
        <div class="card-header">
            <h2 style="font-size: 1.5rem; font-weight: 600; color: white; margin: 0;">
                Planning de la semaine prochaine
            </h2>
        </div>
        <div style="padding: var(--lp-space-lg);">
            @if($data['seances_semaine_prochaine']->count() > 0)
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Entraînement</th>
                                <th>Horaires</th>
                                <th>Lieu</th>
                                <th>Entraîneur</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['seances_semaine_prochaine'] as $seance)
                                <tr>
                                    <td>
                                        <div style="font-weight: 600; color: var(--lp-navy);">
                                            {{ $seance->date_seance->format('d/m/Y') }}
                                        </div>
                                        <div style="font-size: 0.8125rem; color: var(--lp-text-muted);">
                                            {{ $seance->date_seance->isoFormat('dddd') }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 500; color: var(--lp-navy);">
                                            {{ $seance->entrainement->titre ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td style="color: var(--lp-text-secondary);">
                                        {{ $seance->heure_debut }} - {{ $seance->heure_fin }}
                                    </td>
                                    <td style="color: var(--lp-text-secondary);">
                                        {{ $seance->lieu ?? 'À définir' }}
                                    </td>
                                    <td style="color: var(--lp-text-secondary);">
                                        {{ $seance->entrainement->entraineur->user->name ?? 'N/A' }}
                                    </td>
                                    <td>
                                        <div style="display: flex; gap: 0.5rem;">
                                            <a href="{{ route('seances.show', $seance->id) }}" class="btn btn-sm btn-outline">
                                                Voir
                                            </a>
                                            <a href="{{ route('seances.edit', $seance->id) }}" class="btn btn-sm btn-marine">
                                                Modifier
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align: center; padding: 3rem 1.5rem;">
                    <div style="width: 4rem; height: 4rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <svg width="32" height="32" fill="none" stroke="var(--lp-teal)" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                        Aucune séance planifiée
                    </h3>
                    <p style="color: var(--lp-text-muted); margin-bottom: 1.5rem;">
                        Commencez à planifier des séances pour la semaine prochaine.
                    </p>
                    <a href="{{ route('seances.create') }}" class="btn btn-primary">
                        Planifier une séance
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="grid md:grid-cols-4 gap-6">
        <a href="{{ route('seances.index') }}" class="card" style="text-decoration: none; transition: all var(--lp-transition-normal);"
           onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--lp-shadow-lg)'"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
            <div style="text-align: center; padding: 1rem;">
                <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <svg width="28" height="28" fill="none" stroke="var(--lp-teal)" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                    Toutes les séances
                </h3>
                <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                    Planning complet
                </p>
            </div>
        </a>

        <a href="{{ route('entrainements.index') }}" class="card" style="text-decoration: none; transition: all var(--lp-transition-normal);"
           onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--lp-shadow-lg)'"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
            <div style="text-align: center; padding: 1rem;">
                <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <svg width="28" height="28" fill="none" stroke="var(--lp-marine)" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                </div>
                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                    Entraînements
                </h3>
                <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                    Gérer les programmes
                </p>
            </div>
        </a>

        <a href="{{ route('entraineurs.index') }}" class="card" style="text-decoration: none; transition: all var(--lp-transition-normal);"
           onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--lp-shadow-lg)'"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
            <div style="text-align: center; padding: 1rem;">
                <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <svg width="28" height="28" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                    Entraîneurs
                </h3>
                <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                    Équipe pédagogique
                </p>
            </div>
        </a>

        <a href="{{ route('adherents.index') }}" class="card" style="text-decoration: none; transition: all var(--lp-transition-normal);"
           onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--lp-shadow-lg)'"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
            <div style="text-align: center; padding: 1rem;">
                <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <svg width="28" height="28" fill="none" stroke="var(--lp-success)" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                    Adhérents
                </h3>
                <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                    Liste des membres
                </p>
            </div>
        </a>
    </div>
</div>
@endsection
