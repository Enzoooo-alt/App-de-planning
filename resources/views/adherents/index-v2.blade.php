@extends('layouts.app-v2')

@section('title', 'Adhérents - Lyon Palme')

@section('content')
<div class="container" style="padding: 2rem 0;">
    
    <!-- En-tête de la page -->
    <div style="margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div>
                <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
                    Adhérents du Club
                </h1>
                <p style="color: var(--lp-text-muted); font-size: 1.125rem;">
                    Gestion des membres et suivi de l'activité du club
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
                @can('manage_adherents')
                <a href="{{ route('adherents.create') }}" class="btn btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Nouvel Adhérent
                </a>
                @endcan
            </div>
        </div>

        <!-- Statistiques rapides -->
        <div class="grid md:grid-cols-4 gap-6">
            <div class="card" style="border-left: 4px solid var(--lp-success);">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-success) 0%, #22c55e 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Total adhérents</div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                            {{ $adherents->total() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="border-left: 4px solid var(--lp-teal);">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-teal) 0%, var(--lp-teal-light) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Membres actifs</div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                            {{ $stats['actifs'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="border-left: 4px solid var(--lp-marine);">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-marine) 0%, var(--lp-marine-light) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Niveaux définis</div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                            {{ $stats['avec_niveau'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="border-left: 4px solid var(--lp-navy);">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-navy) 0%, var(--lp-navy-light) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Emails renseignés</div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                            {{ $stats['avec_email'] ?? 0 }}
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

    <!-- Liste des adhérents -->
    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="font-size: 1.5rem; font-weight: 600; color: white; margin: 0;">
                Liste des Membres
            </h2>
            <!-- Filtres optionnels -->
            <div style="display: flex; gap: 0.75rem;">
                <select class="form-select" style="background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2); color: white;">
                    <option>Tous les membres</option>
                    <option>Actifs seulement</option>
                    <option>Inactifs</option>
                </select>
                <select class="form-select" style="background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2); color: white;">
                    <option>Tous les niveaux</option>
                    <option>Débutant</option>
                    <option>Intermédiaire</option>
                    <option>Avancé</option>
                </select>
            </div>
        </div>
        
        @if($adherents->count() > 0)
            <div style="padding: 0;">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Membre</th>
                                <th>Contact</th>
                                <th>Niveau</th>
                                <th style="text-align: center;">Statut</th>
                                <th>Date d'adhésion</th>
                                <th style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($adherents as $adherent)
                                <tr>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                                            <div style="width: 2.5rem; height: 2.5rem; background: linear-gradient(135deg, var(--lp-teal) 0%, var(--lp-teal-light) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 1rem;">
                                                {{ strtoupper(substr($adherent->nom, 0, 1) . substr($adherent->prenom, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div style="font-weight: 600; color: var(--lp-navy); font-size: 1.0625rem;">
                                                    {{ $adherent->prenom }} {{ $adherent->nom }}
                                                </div>
                                                @if($adherent->user)
                                                    <div style="font-size: 0.8125rem; color: var(--lp-text-muted);">
                                                        Compte utilisateur lié
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($adherent->email)
                                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem;">
                                                <svg width="14" height="14" fill="none" stroke="var(--lp-marine)" stroke-width="2" viewBox="0 0 24 24">
                                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                    <polyline points="22,6 12,13 2,6"></polyline>
                                                </svg>
                                                <span style="color: var(--lp-text-secondary); font-size: 0.9375rem;">{{ $adherent->email }}</span>
                                            </div>
                                        @endif
                                        @if($adherent->telephone)
                                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                                <svg width="14" height="14" fill="none" stroke="var(--lp-marine)" stroke-width="2" viewBox="0 0 24 24">
                                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                </svg>
                                                <span style="color: var(--lp-text-secondary); font-size: 0.9375rem;">{{ $adherent->telephone }}</span>
                                            </div>
                                        @endif
                                        @if(!$adherent->email && !$adherent->telephone)
                                            <span style="color: var(--lp-text-muted); font-style: italic;">Non renseigné</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($adherent->niveau)
                                            <span class="badge badge-marine">
                                                {{ ucfirst($adherent->niveau) }}
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">Non défini</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        @if($adherent->actif)
                                            <span class="badge badge-success">Actif</span>
                                        @else
                                            <span class="badge badge-warning">Inactif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="color: var(--lp-text-secondary);">
                                            {{ $adherent->date_adhesion ? \Carbon\Carbon::parse($adherent->date_adhesion)->format('d/m/Y') : 'Non renseignée' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                            <a href="{{ route('adherents.show', $adherent->id) }}" class="btn btn-sm btn-outline" title="Voir le profil">
                                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                                Voir
                                            </a>
                                            @can('manage_adherents')
                                                <a href="{{ route('adherents.edit', $adherent->id) }}" class="btn btn-sm btn-marine" title="Modifier">
                                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                    </svg>
                                                    Modifier
                                                </a>
                                                <form action="{{ route('adherents.destroy', $adherent->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet adhérent ?');">
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
                @if($adherents->hasPages())
                    <div style="padding: var(--lp-space-lg); border-top: 1px solid var(--lp-border);">
                        {{ $adherents->links() }}
                    </div>
                @endif
            </div>
        @else
            <div style="padding: var(--lp-space-lg);">
                <div style="text-align: center; padding: 3rem 1.5rem;">
                    <div style="width: 5rem; height: 5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <svg width="40" height="40" fill="none" stroke="var(--lp-teal)" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.75rem;">
                        Aucun adhérent enregistré
                    </h3>
                    <p style="color: var(--lp-text-muted); margin-bottom: 2rem; font-size: 1.0625rem;">
                        Commencez par ajouter vos premiers membres au club.
                    </p>
                    @can('manage_adherents')
                        <a href="{{ route('adherents.create') }}" class="btn btn-primary">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Ajouter un adhérent
                        </a>
                    @endcan
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
