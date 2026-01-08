@extends('layouts.app-v2')

@section('title', 'Tableau de bord - Membre')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <!-- En-tête du Dashboard -->
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
            Bienvenue, {{ Auth::user()->first_name ?? Auth::user()->name }}
        </h1>
        <p style="color: var(--lp-text-muted); font-size: 1.125rem;">
            Tableau de bord membre - Lyon Palme
        </p>
    </div>

    <!-- Statistiques rapides -->
    <div class="grid md:grid-cols-3 gap-6" style="margin-bottom: 2rem;">
        <!-- Prochaines séances -->
        <div class="card" style="border-left: 4px solid var(--lp-teal);">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-teal) 0%, var(--lp-teal-light) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Séances à venir</div>
                    <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $data['prochaines_seances']->count() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Activité du mois -->
        <div class="card" style="border-left: 4px solid var(--lp-marine);">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-marine) 0%, var(--lp-marine-light) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Ce mois-ci</div>
                    <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $stats['seances_ce_mois'] ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Mon profil -->
        <div class="card" style="border-left: 4px solid var(--lp-navy);">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-navy) 0%, var(--lp-navy-light) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Statut</div>
                    <div style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy);">
                        <span class="badge badge-teal">Membre actif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Prochaines séances disponibles -->
    <div class="card" style="margin-bottom: 2rem;">
        <div class="card-header">
            <h2 style="font-size: 1.5rem; font-weight: 600; color: white; margin: 0;">
                Prochaines séances disponibles
            </h2>
        </div>
        <div style="padding: var(--lp-space-lg);">
            @if($data['prochaines_seances']->count() > 0)
                <div class="grid md:grid-cols-2 gap-4">
                    @foreach($data['prochaines_seances'] as $seance)
                        <div class="card" style="border: 2px solid var(--lp-border); transition: all var(--lp-transition-normal);" 
                             onmouseover="this.style.borderColor='var(--lp-teal)'; this.style.transform='translateY(-2px)'"
                             onmouseout="this.style.borderColor='var(--lp-border)'; this.style.transform='translateY(0)'">
                            
                            <!-- En-tête de la carte séance -->
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin: 0;">
                                    {{ $seance->entrainement->titre ?? 'Entraînement' }}
                                </h3>
                                <span class="badge badge-teal">
                                    {{ $seance->date_seance->format('d/m') }}
                                </span>
                            </div>

                            <!-- Détails de la séance -->
                            <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-bottom: 1.5rem;">
                                <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--lp-text-muted); font-size: 0.9375rem;">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color: var(--lp-teal);">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <span>{{ $seance->date_seance->isoFormat('dddd D MMMM YYYY') }}</span>
                                </div>

                                <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--lp-text-muted); font-size: 0.9375rem;">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color: var(--lp-teal);">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    <span>{{ $seance->heure_debut }} - {{ $seance->heure_fin }}</span>
                                </div>

                                @if($seance->lieu)
                                <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--lp-text-muted); font-size: 0.9375rem;">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color: var(--lp-teal);">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    <span>{{ $seance->lieu }}</span>
                                </div>
                                @endif
                            </div>

                            <!-- Actions -->
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.8125rem; color: var(--lp-text-light); font-weight: 500;">
                                    {{ $seance->date_seance->diffForHumans() }}
                                </span>
                                <a href="{{ route('seances.show', $seance->id) }}" class="btn btn-primary btn-sm">
                                    Voir détails
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- État vide -->
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
                        Aucune séance programmée
                    </h3>
                    <p style="color: var(--lp-text-muted); margin-bottom: 1.5rem;">
                        Les nouvelles séances apparaîtront ici dès qu'elles seront planifiées par les entraîneurs.
                    </p>
                    <a href="{{ route('seances.index') }}" class="btn btn-outline">
                        Voir toutes les séances
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
                    Planning des séances
                </h3>
                <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                    Consultez le calendrier complet
                </p>
            </div>
        </a>

        <a href="{{ route('documents.index') }}" class="card" style="text-decoration: none; transition: all var(--lp-transition-normal);"
           onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--lp-shadow-lg)'"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
            <div style="text-align: center; padding: 1rem;">
                <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <span style="font-size: 1.75rem;">📄</span>
                </div>
                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                    Documents
                </h3>
                <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                    Accédez aux documents partagés
                </p>
            </div>
        </a>

        <a href="{{ route('messages.index') }}" class="card" style="text-decoration: none; transition: all var(--lp-transition-normal);"
           onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--lp-shadow-lg)'"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
            <div style="text-align: center; padding: 1rem;">
                <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <span style="font-size: 1.75rem;">💬</span>
                </div>
                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                    Messages
                </h3>
                <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                    Communiquez avec le club
                </p>
            </div>
        </a>

        <a href="{{ route('profile.edit') }}" class="card" style="text-decoration: none; transition: all var(--lp-transition-normal);"
           onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--lp-shadow-lg)'"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
            <div style="text-align: center; padding: 1rem;">
                <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <svg width="28" height="28" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                    Mon profil
                </h3>
                <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                    Gérer mes informations
                </p>
            </div>
        </a>
    </div>
</div>

@push('scripts')
<script>
// Configuration de la locale française pour les dates
document.addEventListener('DOMContentLoaded', function() {
    console.log('Dashboard membre chargé avec succès');
});
</script>
@endpush
@endsection
