@extends('layouts.app-v2')

@section('title', 'Détail du paiement')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <a href="{{ route('paiements.index') }}" style="color: var(--lp-teal); text-decoration: none;">Paiements</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">Détail</span>
    </nav>

    <div class="grid md:grid-cols-3 gap-6">
        <!-- Contenu principal -->
        <div style="grid-column: span 2;">
            <div class="card" style="margin-bottom: 2rem;">
                <div style="padding: var(--lp-space-lg); border-bottom: 1px solid var(--lp-border);">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h1 style="font-size: 1.75rem; font-weight: 700; color: var(--lp-navy);">
                            {!! $paiement->type_label !!}
                        </h1>
                        {!! $paiement->statut_badge !!}
                    </div>
                </div>

                <div style="padding: var(--lp-space-lg);">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div style="padding: 1.5rem; background: var(--lp-bg-ocean); border-radius: var(--lp-radius);">
                            <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.5rem;">Montant</div>
                            <div style="font-size: 2rem; font-weight: 700; color: var(--lp-teal);">
                                {{ number_format($paiement->montant, 2) }}€
                            </div>
                        </div>

                        <div style="padding: 1.5rem; background: var(--lp-bg-ocean); border-radius: var(--lp-radius);">
                            <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.5rem;">Date</div>
                            <div style="font-size: 1.5rem; font-weight: 700; color: var(--lp-navy);">
                                {{ $paiement->date_paiement->format('d/m/Y') }}
                            </div>
                        </div>

                        <div style="padding: 1.5rem; background: var(--lp-bg-ocean); border-radius: var(--lp-radius);">
                            <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.5rem;">Méthode</div>
                            <div style="font-weight: 600; color: var(--lp-navy);">
                                @if($paiement->methode_paiement == 'especes') 💵 Espèces
                                @elseif($paiement->methode_paiement == 'cheque') 📝 Chèque
                                @elseif($paiement->methode_paiement == 'virement') 🏦 Virement
                                @elseif($paiement->methode_paiement == 'carte_bancaire') 💳 Carte bancaire
                                @else 🌐 Paiement en ligne
                                @endif
                            </div>
                        </div>

                        <div style="padding: 1.5rem; background: var(--lp-bg-ocean); border-radius: var(--lp-radius);">
                            <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.5rem;">Saison</div>
                            <div style="font-weight: 600; color: var(--lp-navy);">
                                {{ $paiement->saison }}
                            </div>
                        </div>
                    </div>

                    @if($paiement->recu_numero)
                        <div style="margin-top: 1.5rem; padding: 1.5rem; background: linear-gradient(135deg, var(--lp-navy), var(--lp-teal)); border-radius: var(--lp-radius); color: white;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.25rem;">Reçu disponible</div>
                                    <div style="font-weight: 700; font-size: 1.125rem;">N° {{ $paiement->recu_numero }}</div>
                                </div>
                                <button class="btn" style="background: white; color: var(--lp-navy);">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line x1="12" y1="15" x2="12" y2="3"></line>
                                    </svg>
                                    Télécharger le reçu
                                </button>
                            </div>
                        </div>
                    @endif

                    @if($paiement->note)
                        <div style="margin-top: 1.5rem; padding: 1.5rem; background: var(--lp-bg-ocean); border-radius: var(--lp-radius); border-left: 4px solid var(--lp-teal);">
                            <h3 style="font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">Note</h3>
                            <p style="color: var(--lp-text-muted); line-height: 1.6;">
                                {{ $paiement->note }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('paiements.edit', $paiement) }}" class="btn btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    Modifier
                </a>
                <form method="POST" action="{{ route('paiements.destroy', $paiement) }}" 
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce paiement ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                        Supprimer
                    </button>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <div class="card" style="margin-bottom: 1.5rem;">
                <div style="padding: var(--lp-space-lg); border-bottom: 1px solid var(--lp-border);">
                    <h3 style="font-weight: 600; color: var(--lp-navy);">Informations adhérent</h3>
                </div>
                <div style="padding: var(--lp-space-lg);">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="width: 3rem; height: 3rem; background: var(--lp-teal); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.125rem;">
                            {{ substr($paiement->adherent->prenom, 0, 1) }}{{ substr($paiement->adherent->nom, 0, 1) }}
                        </div>
                        <div>
                            <div style="font-weight: 600; color: var(--lp-navy);">
                                {{ $paiement->adherent->prenom }} {{ $paiement->adherent->nom }}
                            </div>
                            <div style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                {{ $paiement->adherent->email }}
                            </div>
                        </div>
                    </div>

                    @if($paiement->adherent->telephone)
                        <div style="padding: 0.75rem; background: var(--lp-bg-ocean); border-radius: var(--lp-radius); margin-bottom: 0.75rem;">
                            <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Téléphone</div>
                            <div style="font-weight: 600; color: var(--lp-navy);">{{ $paiement->adherent->telephone }}</div>
                        </div>
                    @endif

                    @if($paiement->adherent->date_naissance)
                        <div style="padding: 0.75rem; background: var(--lp-bg-ocean); border-radius: var(--lp-radius);">
                            <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Né(e) le</div>
                            <div style="font-weight: 600; color: var(--lp-navy);">{{ $paiement->adherent->date_naissance->format('d/m/Y') }}</div>
                        </div>
                    @endif

                    <a href="{{ route('adherents.show', $paiement->adherent) }}" class="btn btn-secondary" style="width: 100%; margin-top: 1rem;">
                        Voir le profil complet
                    </a>
                </div>
            </div>

            <a href="{{ route('paiements.index') }}" class="btn btn-secondary" style="width: 100%;">
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
