<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Lyon Palme - Gestion Natation')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Lyon Palme Custom CSS -->
    @vite(['resources/css/lyon-palme.css', 'resources/js/app.js'])
</head>
<body>
    <div class="min-h-screen">
        <!-- Navigation -->
        <header class="site-header">
            <div class="container">
                <div class="brand">🏊 Lyon Palme</div>
                
                <nav class="nav">
                    <a href="/dashboard" class="nav-link">Dashboard</a>
                    <a href="/entraineurs" class="nav-link">Entraîneurs</a>
                    <a href="/adherents" class="nav-link">Adhérents</a>
                    <a href="/entrainements" class="nav-link">Entraînements</a>
                    <a href="/seances" class="nav-link">Séances</a>
                    
                    <!-- Profile User Link -->
                    @auth
                        <div style="position: relative; display: flex; align-items: center; gap: 12px;">
                            <!-- User Profile Link -->
                            <a href="{{ route('profile.edit') }}" class="nav-link" style="display: flex; align-items: center; gap: 8px; padding: 8px 12px; background: rgba(124, 58, 237, 0.1); border-radius: var(--radius); border: 1px solid rgba(124, 58, 237, 0.2);">
                                <span style="font-size: 1.1rem;">👤</span>
                                <span>{{ Auth::user()->name ?? 'Mon Profil' }}</span>
                            </a>
                            
                            <!-- Logout Button -->
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" class="nav-link" style="background: rgba(220, 38, 38, 0.1); border: 1px solid rgba(220, 38, 38, 0.2); border-radius: var(--radius); color: var(--danger); padding: 8px 12px; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                    <span style="font-size: 1rem;">🚪</span>
                                    <span>Déconnexion</span>
                                </button>
                            </form>
                        </div>
                    @endauth
                    
                    @guest
                        <a href="{{ route('login') }}" class="nav-link">Connexion</a>
                        <a href="{{ route('register') }}" class="button button-primary" style="font-size: 0.875rem; padding: 8px 16px;">S'inscrire</a>
                    @endguest
                </nav>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <script>
        // Smooth transitions for hover effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add any custom JavaScript for enhanced UX
        });
    </script>
</body>
</html>
