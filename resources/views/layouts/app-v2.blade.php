<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Lyon Palme - Gestion des Activités Aquatiques')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Lyon Palme Design System v2.0 -->
    @vite(['resources/css/lyon-palme-v2.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body>
    <div style="min-height: 100vh; display: flex; flex-direction: column;">
        <!-- Navigation -->
        <header class="site-header">
            <div class="container">
                <a href="/" class="brand">Lyon Palme</a>
                
                <nav class="nav">
                    @auth
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
                            Tableau de bord
                        </a>
                        <a href="{{ route('entraineurs.index') }}" class="nav-link {{ request()->routeIs('entraineurs.*') ? 'active' : '' }}">
                            Entraîneurs
                        </a>
                        <a href="{{ route('adherents.index') }}" class="nav-link {{ request()->routeIs('adherents.*') ? 'active' : '' }}">
                            Adhérents
                        </a>
                        <a href="{{ route('entrainements.index') }}" class="nav-link {{ request()->routeIs('entrainements.*') ? 'active' : '' }}">
                            Entraînements
                        </a>
                        <a href="{{ route('seances.index') }}" class="nav-link {{ request()->routeIs('seances.*') ? 'active' : '' }}">
                            Séances
                        </a>
                        
                        <!-- User Profile & Logout -->
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-left: auto;">
                            <a href="{{ route('profile.edit') }}" class="nav-link" style="background: rgba(13, 148, 136, 0.1); border: 1px solid rgba(13, 148, 136, 0.2);">
                                {{ Auth::user()->first_name ?? Auth::user()->name ?? 'Profil' }}
                            </a>
                            
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline" style="background: rgba(220, 38, 38, 0.05); border-color: var(--lp-danger); color: var(--lp-danger);">
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="nav-link active">
                            Inscription
                        </a>
                    @endauth
                </nav>
            </div>
        </header>

        <!-- Page Content -->
        <main style="flex: 1;">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="site-footer">
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <div>
                        <p style="font-weight: 600; font-size: 1.125rem; margin-bottom: 0.5rem;">Lyon Palme</p>
                        <p style="margin: 0; font-size: 0.875rem;">Club de plongée et activités aquatiques à Lyon</p>
                    </div>
                    <div style="display: flex; gap: 2rem; flex-wrap: wrap;">
                        <a href="https://www.lyonpalme.com/" target="_blank" rel="noopener" style="color: var(--lp-teal-light);">
                            Site officiel
                        </a>
                        <a href="{{ url('/legal/privacy') }}" style="color: var(--lp-teal-light);">
                            Confidentialité
                        </a>
                        <a href="{{ url('/legal/reglement') }}" style="color: var(--lp-teal-light);">
                            Règlement
                        </a>
                    </div>
                </div>
                <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid rgba(255, 255, 255, 0.1); text-align: center;">
                    <p style="margin: 0; font-size: 0.875rem; color: rgba(255, 255, 255, 0.6);">
                        © {{ date('Y') }} Lyon Palme. Tous droits réservés.
                    </p>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
