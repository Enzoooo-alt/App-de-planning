@extends('layouts.app')

@section('title', 'Lyon Palme - Club de Natation')

@section('content')
<!-- Masquer complètement la navigation sur la page d'accueil -->
<style>
/* Hide header completely for homepage */
.site-header {
    display: none !important;
}

/* Hero Section Styling */
.welcome-hero {
    background: linear-gradient(135deg, #1e3a8a 0%, #3730a3 50%, #7c3aed 100%);
    color: white;
    padding: 80px 0 80px 0;
    position: relative;
    overflow: hidden;
    min-height: 100vh;
    display: flex;
    align-items: center;
}

.welcome-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><defs><pattern id="dots" patternUnits="userSpaceOnUse" width="40" height="40"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100%" height="100%" fill="url(%23dots)"/></svg>');
}

.welcome-hero .container {
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 800;
    margin-bottom: 1.5rem;
    text-align: center;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.25rem;
    margin-bottom: 2rem;
    text-align: center;
    opacity: 0.95;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

.hero-cta {
    text-align: center;
    margin-top: 2rem;
}

.hero-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(59, 130, 246, 0.9);
    color: white;
    padding: 12px 32px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    border: 2px solid rgba(59, 130, 246, 0.5);
}

.hero-button:hover {
    background: rgba(59, 130, 246, 1);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
}

/* Features Section */
.welcome-features {
    padding: 80px 0;
    background: #f8fafc;
}

.features-header {
    text-align: center;
    margin-bottom: 4rem;
}

.features-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1rem;
}

.features-subtitle {
    font-size: 1.125rem;
    color: #64748b;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin-top: 3rem;
}

.feature-card {
    background: white;
    padding: 2rem;
    border-radius: 16px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    text-align: left;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    margin-bottom: 1.5rem;
}

.feature-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.75rem;
}

.feature-description {
    color: #64748b;
    line-height: 1.6;
    font-size: 0.95rem;
}
</style>

<!-- Hero Section -->
<section class="welcome-hero">
    <!-- Navigation minimaliste pour utilisateurs connectés -->
    @auth
        <div class="minimal-nav" style="position: absolute; top: 20px; right: 20px; z-index: 10;">
            <div style="display: flex; gap: 1rem; align-items: center;">
                <a href="{{ route('dashboard') }}" style="color: white; text-decoration: none; padding: 8px 16px; background: rgba(255,255,255,0.1); border-radius: 20px; font-weight: 500; backdrop-filter: blur(10px);">
                    🏊 Dashboard
                </a>
                <a href="{{ route('profile.edit') }}" style="color: white; text-decoration: none; padding: 8px 16px; background: rgba(255,255,255,0.1); border-radius: 20px; font-weight: 500; backdrop-filter: blur(10px);">
                    👤 {{ Auth::user()->name }}
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" style="color: white; background: rgba(220, 38, 38, 0.2); border: none; padding: 8px 16px; border-radius: 20px; font-weight: 500; cursor: pointer; backdrop-filter: blur(10px);">
                        🚪 Déconnexion
                    </button>
                </form>
            </div>
        </div>
    @endauth
    
    <!-- Navigation minimaliste pour utilisateurs non connectés -->
    @guest
        <div class="minimal-nav" style="position: absolute; top: 20px; right: 20px; z-index: 10;">
            <div style="display: flex; gap: 1rem; align-items: center;">
                <a href="{{ route('login') }}" style="color: white; text-decoration: none; padding: 8px 16px; background: rgba(255,255,255,0.1); border-radius: 20px; font-weight: 500; backdrop-filter: blur(10px);">
                    🔑 Connexion
                </a>
                <a href="{{ route('register') }}" style="color: white; text-decoration: none; padding: 8px 16px; background: rgba(59, 130, 246, 0.3); border-radius: 20px; font-weight: 500; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
                    ✨ S'inscrire
                </a>
            </div>
        </div>
    @endguest
    
    <div class="container">
        <h1 class="hero-title">
            Bienvenue chez<br>
            <span style="color: #fbbf24;">Lyon Palme</span>
        </h1>
        <p class="hero-subtitle">
            Votre plateforme de gestion pour la natation synchronisée. Organisez vos
            entraînements, suivez vos progrès et connectez-vous avec votre équipe.
        </p>
        
        <div class="hero-cta">
            @guest
                <a href="{{ route('login') }}" class="hero-button">
                    Accéder au Dashboard
                </a>
            @else
                <a href="{{ url('/dashboard') }}" class="hero-button">
                    Accéder au Dashboard
                </a>
            @endguest
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="welcome-features">
    <div class="container">
        <div class="features-header">
            <p style="color: #3b82f6; font-weight: 600; text-transform: uppercase; font-size: 0.875rem; letter-spacing: 0.1em; margin-bottom: 1rem;">
                FONCTIONNALITÉS
            </p>
            <h2 class="features-title">Tout pour vos entraînements</h2>
            <p class="features-subtitle">
                Lyon Palme vous offre tous les outils nécessaires pour gérer efficacement
                vos sessions de natation synchronisée.
            </p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">📋</div>
                <h3 class="feature-title">Gestion des entraînements</h3>
                <p class="feature-description">
                    Créez, organisez et suivez vos programmes d'entraînement de natation
                    synchronisée.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">📅</div>
                <h3 class="feature-title">Planning des séances</h3>
                <p class="feature-description">
                    Planifiez facilement vos séances et gérez les horaires de votre équipe.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">👥</div>
                <h3 class="feature-title">Suivi des adhérents</h3>
                <p class="feature-description">
                    Gardez une trace des progrès de vos nageurs et de leur participation.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3 class="feature-title">Statistiques détaillées</h3>
                <p class="feature-description">
                    Analysez les performances et suivez l'évolution avec des rapports
                    complets.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section style="background: linear-gradient(135deg, #1e3a8a 0%, #3730a3 50%, #7c3aed 100%); color: white; padding: 80px 0; position: relative;">
    <div class="container" style="text-align: center; position: relative; z-index: 2;">
        <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: white; font-weight: 700;">
            Prêt à plonger ?
        </h2>
        <p style="font-size: 1.125rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9); max-width: 500px; margin-left: auto; margin-right: auto; line-height: 1.6;">
            Rejoignez Lyon Palme dès aujourd'hui et transformez la gestion de vos
            entraînements.
        </p>
        @guest
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('register') }}" style="background: white; color: #1e3a8a; padding: 12px 32px; border-radius: 50px; text-decoration: none; font-weight: 600; font-size: 1rem; transition: all 0.3s ease;">
                    S'inscrire maintenant
                </a>
                <a href="{{ route('login') }}" style="background: transparent; color: white; padding: 12px 32px; border-radius: 50px; text-decoration: none; font-weight: 600; font-size: 1rem; border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s ease;">
                    Se connecter
                </a>
            </div>
        @else
            <a href="{{ url('/dashboard') }}" style="background: white; color: #1e3a8a; padding: 12px 32px; border-radius: 50px; text-decoration: none; font-weight: 600; font-size: 1rem; transition: all 0.3s ease;">
                Accéder à votre espace
            </a>
        @endguest
    </div>
    <!-- Background pattern -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 100 100&quot;><defs><pattern id=&quot;waves&quot; patternUnits=&quot;userSpaceOnUse&quot; width=&quot;50&quot; height=&quot;50&quot;><path d=&quot;M0,25 Q12.5,10 25,25 T50,25&quot; fill=&quot;none&quot; stroke=&quot;rgba(255,255,255,0.1)&quot; stroke-width=&quot;1&quot;/></pattern></defs><rect width=&quot;100%&quot; height=&quot;100%&quot; fill=&quot;url(%23waves)&quot;/></svg>'); opacity: 0.3;"></div>
</section>

<!-- Footer -->
<footer style="background: #0f172a; color: white; padding: 40px 0; text-align: center;">
    <div class="container">
        <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 16px; color: #fbbf24;">
            🏊 Lyon Palme
        </h3>
        <p style="margin-bottom: 24px; color: #94a3b8; font-size: 1rem;">
            Votre club de natation synchronisée de référence à Lyon
        </p>
        <div style="display: flex; justify-content: center; gap: 2rem; margin-bottom: 24px; flex-wrap: wrap; color: #94a3b8;">
            <span style="display: flex; align-items: center; gap: 8px;">
                📧 contact@lyonpalme.fr
            </span>
            <span style="display: flex; align-items: center; gap: 8px;">
                📞 04 XX XX XX XX
            </span>
        </div>
        <div style="padding-top: 24px; border-top: 1px solid #334155;">
            <p style="color: #64748b; font-size: 0.875rem;">
                &copy; {{ date('Y') }} Lyon Palme. Tous droits réservés.
            </p>
        </div>
    </div>
</footer>
@endsection
