@extends('layouts.app-v2')

@section('title', 'Tableau de bord - Président')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <!-- En-tête du Dashboard -->
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
            Vue d'ensemble du club
        </h1>
        <p style="color: var(--lp-text-muted); font-size: 1.125rem;">
            Président - {{ Auth::user()->first_name ?? Auth::user()->name }}
        </p>
    </div>

    <!-- Statistiques principales -->
    <div class="grid md:grid-cols-4 gap-6" style="margin-bottom: 2rem;">
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
                        {{ $stats['total_adherents'] ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="border-left: 4px solid var(--lp-marine);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-marine) 0%, var(--lp-marine-light) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Entraîneurs</div>
                    <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $stats['total_entraineurs'] ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

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
                    <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Séances ce mois</div>
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
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Programmes actifs</div>
                    <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $stats['total_entrainements'] ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Répartition par rôle -->
    <div class="grid md:grid-cols-2 gap-6" style="margin-bottom: 2rem;">
        <div class="card">
            <div class="card-header">
                <h2 style="font-size: 1.5rem; font-weight: 600; color: white; margin: 0;">
                    Répartition des membres
                </h2>
            </div>
            <div style="padding: var(--lp-space-lg);">
                @if(isset($data['members_by_role']) && count($data['members_by_role']) > 0)
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        @foreach($data['members_by_role'] as $role)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: var(--lp-bg-ocean); border-radius: var(--lp-radius-md);">
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div style="width: 2.5rem; height: 2.5rem; background: 
                                        {{ $role->nom === 'membre' ? 'var(--lp-success)' : 
                                           ($role->nom === 'entraineur' ? 'var(--lp-marine)' : 
                                           ($role->nom === 'responsable_planning' ? 'var(--lp-teal)' : 'var(--lp-navy)')) }}; 
                                        border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <svg width="20" height="20" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                    </div>
                                    <div>
                                        <div style="font-weight: 600; color: var(--lp-navy); text-transform: capitalize;">
                                            {{ str_replace('_', ' ', $role->nom) }}
                                        </div>
                                        <div style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                            {{ $role->users_count }} {{ $role->users_count > 1 ? 'personnes' : 'personne' }}
                                        </div>
                                    </div>
                                </div>
                                <div style="font-size: 1.5rem; font-weight: 700; color: var(--lp-navy);">
                                    {{ $role->users_count }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 2rem;">
                        <p style="color: var(--lp-text-muted);">Aucune donnée disponible</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Activités récentes -->
        <div class="card">
            <div class="card-header">
                <h2 style="font-size: 1.5rem; font-weight: 600; color: white; margin: 0;">
                    Activités récentes
                </h2>
            </div>
            <div style="padding: var(--lp-space-lg);">
                @if(isset($data['recent_activities']) && count($data['recent_activities']) > 0)
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        @foreach($data['recent_activities'] as $activity)
                            <div style="display: flex; gap: 1rem; padding: 1rem; background: var(--lp-bg-ocean); border-radius: var(--lp-radius-md); border-left: 3px solid 
                                {{ $activity['type'] === 'seance' ? 'var(--lp-teal)' : 
                                   ($activity['type'] === 'adherent' ? 'var(--lp-success)' : 'var(--lp-marine)') }};">
                                <div style="width: 2.5rem; height: 2.5rem; background: 
                                    {{ $activity['type'] === 'seance' ? 'var(--lp-teal)' : 
                                       ($activity['type'] === 'adherent' ? 'var(--lp-success)' : 'var(--lp-marine)') }}; 
                                    border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg width="18" height="18" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                        @if($activity['type'] === 'seance')
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                        @elseif($activity['type'] === 'adherent')
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="8.5" cy="7" r="4"></circle>
                                        @else
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                        @endif
                                    </svg>
                                </div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 600; color: var(--lp-navy); margin-bottom: 0.25rem;">
                                        {{ $activity['title'] }}
                                    </div>
                                    <div style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                        {{ $activity['date'] }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 2rem;">
                        <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <svg width="28" height="28" fill="none" stroke="var(--lp-teal)" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            </svg>
                        </div>
                        <p style="color: var(--lp-text-muted);">Aucune activité récente</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Actions administratives -->
    <div class="card" style="margin-bottom: 2rem;">
        <div class="card-header">
            <h2 style="font-size: 1.5rem; font-weight: 600; color: white; margin: 0;">
                Actions administratives
            </h2>
        </div>
        <div style="padding: var(--lp-space-lg);">
            <div class="grid md:grid-cols-3 gap-6">
                <a href="{{ route('adherents.index') }}" class="card" style="text-decoration: none; border: 2px solid var(--lp-border); transition: all var(--lp-transition-normal);"
                   onmouseover="this.style.borderColor='var(--lp-success)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='var(--lp-shadow-md)'"
                   onmouseout="this.style.borderColor='var(--lp-border)'; this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
                    <div style="text-align: center; padding: 1.5rem;">
                        <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <svg width="28" height="28" fill="none" stroke="var(--lp-success)" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                            Gérer les adhérents
                        </h3>
                        <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                            Inscription, suivi et gestion
                        </p>
                    </div>
                </a>

                <a href="{{ route('entraineurs.index') }}" class="card" style="text-decoration: none; border: 2px solid var(--lp-border); transition: all var(--lp-transition-normal);"
                   onmouseover="this.style.borderColor='var(--lp-marine)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='var(--lp-shadow-md)'"
                   onmouseout="this.style.borderColor='var(--lp-border)'; this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
                    <div style="text-align: center; padding: 1.5rem;">
                        <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <svg width="28" height="28" fill="none" stroke="var(--lp-marine)" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                            Gérer les entraîneurs
                        </h3>
                        <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                            Équipe pédagogique
                        </p>
                    </div>
                </a>

                <a href="{{ route('entrainements.index') }}" class="card" style="text-decoration: none; border: 2px solid var(--lp-border); transition: all var(--lp-transition-normal);"
                   onmouseover="this.style.borderColor='var(--lp-navy)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='var(--lp-shadow-md)'"
                   onmouseout="this.style.borderColor='var(--lp-border)'; this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
                    <div style="text-align: center; padding: 1.5rem;">
                        <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <svg width="28" height="28" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                            </svg>
                        </div>
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                            Programmes
                        </h3>
                        <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                            Entraînements et contenus
                        </p>
                    </div>
                </a>

                <a href="{{ route('seances.index') }}" class="card" style="text-decoration: none; border: 2px solid var(--lp-border); transition: all var(--lp-transition-normal);"
                   onmouseover="this.style.borderColor='var(--lp-teal)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='var(--lp-shadow-md)'"
                   onmouseout="this.style.borderColor='var(--lp-border)'; this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
                    <div style="text-align: center; padding: 1.5rem;">
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
                            Calendrier complet
                        </p>
                    </div>
                </a>

                <a href="{{ route('users.create') }}" class="card" style="text-decoration: none; border: 2px solid var(--lp-border); transition: all var(--lp-transition-normal);"
                   onmouseover="this.style.borderColor='var(--lp-success)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='var(--lp-shadow-md)'"
                   onmouseout="this.style.borderColor='var(--lp-border)'; this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
                    <div style="text-align: center; padding: 1.5rem;">
                        <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <svg width="28" height="28" fill="none" stroke="var(--lp-success)" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <path d="M20 8v6M23 11h-6"></path>
                            </svg>
                        </div>
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                            Nouvel utilisateur
                        </h3>
                        <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                            Créer un compte
                        </p>
                    </div>
                </a>

                <a href="{{ route('presences.index') }}" class="card" style="text-decoration: none; border: 2px solid var(--lp-border); transition: all var(--lp-transition-normal);"
                   onmouseover="this.style.borderColor='#10b981'; this.style.transform='translateY(-2px)'; this.style.boxShadow='var(--lp-shadow-md)'"
                   onmouseout="this.style.borderColor='var(--lp-border)'; this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
                    <div style="text-align: center; padding: 1.5rem;">
                        <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <span style="font-size: 1.75rem;">📋</span>
                        </div>
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                            Présences
                        </h3>
                        <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                            Suivi et statistiques
                        </p>
                    </div>
                </a>

                <a href="{{ route('paiements.dashboard') }}" class="card" style="text-decoration: none; border: 2px solid var(--lp-border); transition: all var(--lp-transition-normal);"
                   onmouseover="this.style.borderColor='var(--lp-teal)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='var(--lp-shadow-md)'"
                   onmouseout="this.style.borderColor='var(--lp-border)'; this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
                    <div style="text-align: center; padding: 1.5rem;">
                        <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <span style="font-size: 1.75rem;">💰</span>
                        </div>
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                            Paiements
                        </h3>
                        <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                            Cotisations et finances
                        </p>
                    </div>
                </a>

                <a href="{{ route('documents.index') }}" class="card" style="text-decoration: none; border: 2px solid var(--lp-border); transition: all var(--lp-transition-normal);"
                   onmouseover="this.style.borderColor='var(--lp-navy)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='var(--lp-shadow-md)'"
                   onmouseout="this.style.borderColor='var(--lp-border)'; this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
                    <div style="text-align: center; padding: 1.5rem;">
                        <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <span style="font-size: 1.75rem;">📄</span>
                        </div>
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                            Documents
                        </h3>
                        <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                            Bibliothèque partagée
                        </p>
                    </div>
                </a>

                <a href="{{ route('messages.index') }}" class="card" style="text-decoration: none; border: 2px solid var(--lp-border); transition: all var(--lp-transition-normal);"
                   onmouseover="this.style.borderColor='#f59e0b'; this.style.transform='translateY(-2px)'; this.style.boxShadow='var(--lp-shadow-md)'"
                   onmouseout="this.style.borderColor='var(--lp-border)'; this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
                    <div style="text-align: center; padding: 1.5rem;">
                        <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <span style="font-size: 1.75rem;">💬</span>
                        </div>
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                            Messages
                        </h3>
                        <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                            Communication interne
                        </p>
                    </div>
                </a>

                <a href="{{ route('actualites.manage') }}" class="card" style="text-decoration: none; border: 2px solid var(--lp-border); transition: all var(--lp-transition-normal);"
                   onmouseover="this.style.borderColor='var(--lp-teal)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='var(--lp-shadow-md)'"
                   onmouseout="this.style.borderColor='var(--lp-border)'; this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
                    <div style="text-align: center; padding: 1.5rem;">
                        <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <span style="font-size: 1.75rem;">📰</span>
                        </div>
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                            Actualités
                        </h3>
                        <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                            Gérer les publications
                        </p>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}" class="card" style="text-decoration: none; border: 2px solid var(--lp-border); transition: all var(--lp-transition-normal);"
                   onmouseover="this.style.borderColor='var(--lp-navy)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='var(--lp-shadow-md)'"
                   onmouseout="this.style.borderColor='var(--lp-border)'; this.style.transform='translateY(0)'; this.style.boxShadow='var(--lp-shadow-sm)'">
                    <div style="text-align: center; padding: 1.5rem;">
                        <div style="width: 3.5rem; height: 3.5rem; background: var(--lp-bg-ocean); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <svg width="28" height="28" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                            </svg>
                        </div>
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                            Paramètres
                        </h3>
                        <p style="color: var(--lp-text-muted); font-size: 0.9375rem;">
                            Configuration du compte
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
