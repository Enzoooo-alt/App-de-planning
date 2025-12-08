@extends('layouts.app')

@section('title', 'Dashboard - Lyon Palme')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Navigation -->
    <nav class="nav-container">
        <div class="container">
            <div class="nav-flex">
                <div class="nav-left">
                    <div class="nav-logo">
                        <h1 class="nav-title">Lyon Palme</h1>
                    </div>
                    <div class="nav-links">
                        <a href="{{ route('dashboard') }}" class="nav-link-active">
                            Dashboard
                        </a>
                    </div>
                </div>
                <div class="nav-right">
                    <div class="nav-user-menu">
                        <div class="nav-user-info">
                            <span class="nav-username">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link">
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="page-header">
        <div class="container section">
            <h2 class="page-title">
                Tableau de Bord Lyon Palme
            </h2>
        </div>
    </header>

    <!-- Main Content -->
    <div class="section">
        <div class="container">
            <!-- Message de bienvenue -->
            <div class="welcome-card gradient-bg">
                <div class="welcome-content">
                    <h3 class="welcome-title">Bienvenue sur Lyon Palme !</h3>
                    <p>Gérez vos entraînements de natation synchronisée depuis votre tableau de bord.</p>
                </div>
            </div>

            <!-- Statistiques principales -->
            <div class="dashboard-stats-grid">
                <!-- Entraîneurs -->
                <div class="stat-card-enhanced">
                    <div class="stat-card-content">
                        <div class="stat-icon-enhanced blue">
                            <svg class="stat-svg blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="stat-text">Entraîneurs</p>
                            <p class="stat-number">{{ $stats['trainers'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Adhérents -->
                <div class="stat-card-enhanced">
                    <div class="stat-card-content">
                        <div class="stat-icon-enhanced purple">
                            <svg class="stat-svg purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="stat-text">Adhérents</p>
                            <p class="stat-number">{{ $stats['members'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Programmes d'entraînement -->
                <div class="stat-card-enhanced">
                    <div class="stat-card-content">
                        <div class="stat-icon-enhanced green">
                            <svg class="stat-svg green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="stat-text">Programmes</p>
                            <p class="stat-number">{{ $stats['trainings'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Séances -->
                <div class="stat-card-enhanced">
                    <div class="stat-card-content">
                        <div class="stat-icon-enhanced orange">
                            <svg class="stat-svg orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="stat-text">Séances</p>
                            <p class="stat-number">{{ $stats['sessions'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sections principales -->
            <div class="dashboard-main-grid">
                <!-- Séances à venir -->
                <div class="content-card">
                    <h3 class="content-title">Séances à venir</h3>
                    @if($upcomingSessions && count($upcomingSessions) > 0)
                        <div class="content-list">
                            @foreach($upcomingSessions as $session)
                            <div class="session-item-enhanced">
                                <div class="item-dot blue"></div>
                                <div class="item-content">
                                    <p class="item-title">{{ $session->entrainement->titre ?? 'Programme sans titre' }}</p>
                                    <p class="item-subtitle">
                                        {{ \Carbon\Carbon::parse($session->dateSeance)->format('d/m/Y') }} 
                                        de {{ \Carbon\Carbon::parse($session->heureDebut)->format('H:i') }} 
                                        à {{ \Carbon\Carbon::parse($session->heureFin)->format('H:i') }}
                                    </p>
                                </div>
                                <div class="item-meta">
                                    @if($session->entrainement && $session->entrainement->entraineur)
                                        {{ $session->entrainement->entraineur->prenom }} {{ $session->entrainement->entraineur->nom }}
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="empty-text">Aucune séance programmée</p>
                        </div>
                    @endif
                </div>

                <!-- Entraînements récents -->
                <div class="content-card">
                    <h3 class="content-title">Programmes récents</h3>
                    @if($recentTrainings && count($recentTrainings) > 0)
                        <div class="content-list">
                            @foreach($recentTrainings as $training)
                            <div class="training-item-enhanced">
                                <div class="item-dot green"></div>
                                <div class="item-content">
                                    <p class="item-title">{{ $training->titre }}</p>
                                    <p class="item-subtitle">
                                        @if($training->entraineur)
                                            Par {{ $training->entraineur->prenom }} {{ $training->entraineur->nom }}
                                        @endif
                                    </p>
                                </div>
                                <div class="item-meta">
                                    {{ \Carbon\Carbon::parse($training->dateCreation)->format('d/m/Y') }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="empty-text">Aucun programme créé</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Informations système -->
            <div class="info-section">
                <div class="info-section-content">
                    <h3 class="info-section-title">
                         Bienvenue sur Lyon Palme !
                    </h3>
                    <div class="info-highlight">
                        <p class="info-description">
                            Vous êtes maintenant connecté à la plateforme Lyon Palme. Cette application vous permet de :
                        </p>
                        <ul class="info-features">
                            <li class="info-feature">
                                <span class="info-feature-dot blue"></span>
                                Créer et gérer vos entraînements de natation synchronisée
                            </li>
                            <li class="info-feature">
                                <span class="info-feature-dot green"></span>
                                Planifier des séances d'entraînement
                            </li>
                            <li class="info-feature">
                                <span class="info-feature-dot purple"></span>
                                Suivre la progression des adhérents
                            </li>
                            <li class="info-feature">
                                <span class="info-feature-dot orange"></span>
                                Échanger avec d'autres entraîneurs
                            </li>
                        </ul>
                        <div class="info-footer">
                            <p class="info-disclaimer">
                                 Attention : Cette application est en phase de développement. Certaines fonctionnalités peuvent ne pas être entièrement opérationnelles. N'oubliez pas de pousser vos améliorations sur le GitHub commun !
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
