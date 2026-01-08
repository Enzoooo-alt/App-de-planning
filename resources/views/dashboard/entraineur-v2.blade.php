@extends('layouts.app-v2')

@section('title', 'Tableau de bord - Entraîneur')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <!-- En-tête du Dashboard -->
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
            Tableau de bord entraîneur
        </h1>
        <p style="color: var(--lp-text-muted); font-size: 1.125rem;">
            Gérez vos entraînements et séances - {{ Auth::user()->first_name ?? Auth::user()->name }}
        </p>
    </div>

    <!-- Statistiques rapides -->
    <div class="grid md:grid-cols-4 gap-6" style="margin-bottom: 2rem;">
        <!-- Mes séances cette semaine -->
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
                    <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Cette semaine</div>
                    <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $data['mes_seances_semaine']->count() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Séances à venir -->
        <div class="card" style="border-left: 4px solid var(--lp-marine);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-marine) 0%, var(--lp-marine-light) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">À venir</div>
                    <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $data['prochaines_seances']->count() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Mes entraînements -->
        <div class="card" style="border-left: 4px solid var(--lp-navy);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-navy) 0%, var(--lp-navy-light) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Programmes</div>
                    <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $stats['mes_entrainements'] ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Nouveau bouton -->
        <a href="{{ route('entrainements.create') }}" class="card" style="border: 2px dashed var(--lp-teal); background: var(--lp-bg-ocean); text-decoration: none; transition: all var(--lp-transition-normal);"
           onmouseover="this.style.background='var(--lp-teal)'; this.querySelectorAll('svg, div, span').forEach(el => el.style.color='white')"
           onmouseout="this.style.background='var(--lp-bg-ocean)'; this.querySelectorAll('svg, div, span').forEach(el => el.style.color='')">
            <div style="display: flex; align-items: center; justify-content: center; gap: 0.75rem; height: 100%;">
                <svg width="24" height="24" fill="none" stroke="var(--lp-teal)" stroke-width="2" viewBox="0 0 24 24" style="transition: all var(--lp-transition-fast);">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <div style="color: var(--lp-teal); font-weight: 600; transition: all var(--lp-transition-fast);">
                    Nouvel entraînement
                </div>
            </div>
        </a>
    </div>

    <!-- Planning de la semaine -->
    <div class="card" style="margin-bottom: 2rem;">
        <div class="card-header">
            <h2 style="font-size: 1.5rem; font-weight: 600; color: white; margin: 0;">
                Mes séances de la semaine
            </h2>
        </div>
        <div style="padding: var(--lp-space-lg);">
            @if($data['mes_seances_semaine']->count() > 0)
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Entraînement</th>
                                <th>Horaires</th>
                                <th>Lieu</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['mes_seances_semaine'] as $seance)
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
                                    <td>
                                        @if($seance->date_seance->isPast())
                                            <span class="badge" style="background: var(--lp-info-light); color: var(--lp-info);">Terminée</span>
                                        @elseif($seance->date_seance->isToday())
                                            <span class="badge badge-warning">Aujourd'hui</span>
                                        @else
                                            <span class="badge badge-teal">Programmée</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('seances.show', $seance->id) }}" class="btn btn-sm btn-outline">
                                            Voir
                                        </a>
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
                        Aucune séance cette semaine
                    </h3>
                    <p style="color: var(--lp-text-muted); margin-bottom: 1.5rem;">
                        Créez un nouvel entraînement et planifiez des séances.
                    </p>
                    <a href="{{ route('entrainements.create') }}" class="btn btn-primary">
                        Créer un entraînement
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Prochaines séances -->
    <div class="card" style="margin-bottom: 2rem;">
        <div style="padding: var(--lp-space-lg); border-bottom: 1px solid var(--lp-border);">
            <h2 style="font-size: 1.25rem; font-weight: 600; color: var(--lp-navy); margin: 0;">
                Prochaines séances
            </h2>
        </div>
        <div style="padding: var(--lp-space-lg);">
            @if($data['prochaines_seances']->count() > 0)
                <div class="grid md:grid-cols-3 gap-4">
                    @foreach($data['prochaines_seances'] as $seance)
                        <div class="card" style="border: 2px solid var(--lp-border); transition: all var(--lp-transition-normal);" 
                             onmouseover="this.style.borderColor='var(--lp-teal)'; this.style.transform='translateY(-2px)'"
                             onmouseout="this.style.borderColor='var(--lp-border)'; this.style.transform='translateY(0)'">
                            
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin: 0;">
                                    {{ $seance->entrainement->titre ?? 'Entraînement' }}
                                </h3>
                                <span class="badge badge-teal">
                                    {{ $seance->date_seance->format('d/m') }}
                                </span>
                            </div>

                            <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-bottom: 1.5rem;">
                                <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--lp-text-muted); font-size: 0.9375rem;">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color: var(--lp-teal);">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    <span>{{ $seance->heure_debut }} - {{ $seance->heure_fin }}</span>
                                </div>

                                <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--lp-text-muted); font-size: 0.9375rem;">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color: var(--lp-teal);">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    <span>{{ $seance->lieu ?? 'À définir' }}</span>
                                </div>
                            </div>

                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.8125rem; color: var(--lp-text-light);">
                                    {{ $seance->date_seance->diffForHumans() }}
                                </span>
                                <a href="{{ route('seances.show', $seance->id) }}" class="btn btn-sm btn-marine">
                                    Gérer
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p style="text-align: center; color: var(--lp-text-muted); padding: 2rem;">
                    Aucune séance à venir pour le moment.
                </p>
            @endif
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="grid md:grid-cols-3 gap-6">
        <a href="{{ route('entrainements.index') }}" class="card" style="text-decoration: none; transition: all var(--lp-transition-normal);"
           onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--lp-shadow-lg)'"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
            <div style="text-align: center; padding: 1rem;">
                <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <svg width="28" height="28" fill="none" stroke="var(--lp-teal)" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                </div>
                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                    Mes entraînements
                </h3>
                <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                    Gérer mes programmes
                </p>
            </div>
        </a>

        <a href="{{ route('seances.index') }}" class="card" style="text-decoration: none; transition: all var(--lp-transition-normal);"
           onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--lp-shadow-lg)'"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
            <div style="text-align: center; padding: 1rem;">
                <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <svg width="28" height="28" fill="none" stroke="var(--lp-marine)" stroke-width="2" viewBox="0 0 24 24">
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

        <a href="{{ route('adherents.index') }}" class="card" style="text-decoration: none; transition: all var(--lp-transition-normal);"
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
