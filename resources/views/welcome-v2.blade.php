@extends('layouts.app-v2')

@section('title', 'Lyon Palme - Club de Plongée et Activités Aquatiques')

@section('content')
<!-- Masquer le header sur la page d'accueil -->
<style>
.site-header {
    display: none !important;
}

/* Hero Section */
.welcome-hero {
    background: linear-gradient(135deg, #0c4a6e 0%, #0d9488 50%, #0284c7 100%);
    color: white;
    padding: 80px 0;
    position: relative;
    overflow: hidden;
    min-height: 90vh;
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
    background: 
        radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.06) 0%, transparent 50%);
    pointer-events: none;
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
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.hero-subtitle {
    font-size: 1.25rem;
    margin-bottom: 2rem;
    text-align: center;
    opacity: 0.95;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

.hero-cta {
    text-align: center;
    margin-top: 2rem;
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.hero-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: white;
    color: #0c4a6e;
    padding: 14px 36px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.hero-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
    text-decoration: none;
}

.hero-button-secondary {
    background: transparent;
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.4);
}

.hero-button-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: white;
}

/* Navigation minimaliste */
.minimal-nav {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 10;
}

.nav-button {
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 25px;
    font-weight: 500;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.nav-button:hover {
    background: rgba(255, 255, 255, 0.2);
    text-decoration: none;
}

.nav-button-primary {
    background: rgba(13, 148, 136, 0.3);
    border-color: rgba(13, 148, 136, 0.5);
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

.section-badge {
    color: #0d9488;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.875rem;
    letter-spacing: 0.1em;
    margin-bottom: 1rem;
}

.features-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 1rem;
}

.features-subtitle {
    font-size: 1.125rem;
    color: #64748b;
    max-width: 700px;
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
    text-align: center;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 25px rgba(13, 148, 136, 0.15);
    border-color: #0d9488;
}

.feature-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #0d9488 0%, #0284c7 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    margin: 0 auto 1.5rem;
    box-shadow: 0 4px 12px rgba(13, 148, 136, 0.3);
}

.feature-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 0.75rem;
}

.feature-description {
    color: #64748b;
    line-height: 1.6;
    font-size: 0.95rem;
}

/* CTA Section */
.cta-section {
    background: linear-gradient(135deg, #0c4a6e 0%, #0d9488 100%);
    color: white;
    padding: 80px 0;
    position: relative;
    overflow: hidden;
}

.cta-section::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="waves" patternUnits="userSpaceOnUse" width="50" height="50"><path d="M0,25 Q12.5,10 25,25 T50,25" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23waves)"/></svg>');
    opacity: 0.3;
}

.cta-content {
    text-align: center;
    position: relative;
    z-index: 2;
}

.cta-title {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    color: white;
    font-weight: 700;
}

.cta-description {
    font-size: 1.125rem;
    margin-bottom: 2rem;
    color: rgba(255, 255, 255, 0.9);
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

/* Footer */
.site-footer {
    background: #0f172a;
    color: white;
    padding: 60px 0 30px;
}

.footer-content {
    text-align: center;
}

.footer-brand {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 16px;
    color: #0d9488;
}

.footer-description {
    margin-bottom: 24px;
    color: #94a3b8;
    font-size: 1rem;
}

.footer-links {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-bottom: 24px;
    flex-wrap: wrap;
    color: #94a3b8;
}

.footer-link {
    color: #94a3b8;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-link:hover {
    color: #0d9488;
}

.footer-bottom {
    padding-top: 24px;
    border-top: 1px solid #334155;
    margin-top: 24px;
}

.footer-copyright {
    color: #64748b;
    font-size: 0.875rem;
}

@media (max-width: 768px) {
    .welcome-hero {
        padding: 60px 0;
        min-height: 100vh;
    }
    
    .hero-title {
        font-size: 2.25rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
        padding: 0 1rem;
    }
    
    .minimal-nav {
        position: static;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-bottom: 2rem;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .feature-card {
        padding: 1.5rem;
    }
}
</style>

<!-- Hero Section -->
<section class="welcome-hero">
    <!-- Navigation minimaliste -->
    @auth
        <div class="minimal-nav">
            <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                <a href="{{ route('dashboard') }}" class="nav-button nav-button-primary">
                    Dashboard
                </a>
                <a href="{{ route('profile.edit') }}" class="nav-button">
                    {{ Auth::user()->name }}
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-button" style="cursor: pointer; border: none; font-family: inherit; font-size: inherit;">
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    @endauth
    
    @guest
        <div class="minimal-nav">
            <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                <a href="{{ route('login') }}" class="nav-button">
                    Connexion
                </a>
                <a href="{{ route('register') }}" class="nav-button nav-button-primary">
                    Inscription
                </a>
            </div>
        </div>
    @endguest
    
    <div class="container">
        <h1 class="hero-title">
            Lyon Palme<br>
            <span style="color: #99f6e4;">Votre Club d'Activités Aquatiques</span>
        </h1>
        <p class="hero-subtitle">
            Plongée sous-marine, natation et activités aquatiques à Lyon. 
            Plateforme professionnelle de gestion des entraînements, séances et adhésions.
        </p>
        
        <div class="hero-cta">
            @guest
                <a href="{{ route('register') }}" class="hero-button">
                    Rejoindre le club
                </a>
                <a href="{{ route('login') }}" class="hero-button hero-button-secondary">
                    Se connecter
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="hero-button">
                    Accéder au tableau de bord
                </a>
            @endguest
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="welcome-features">
    <div class="container">
        <div class="features-header">
            <div class="section-badge">NOS SERVICES</div>
            <h2 class="features-title">Une plateforme complète pour vos activités aquatiques</h2>
            <p class="features-subtitle">
                Lyon Palme vous offre tous les outils nécessaires pour gérer efficacement
                vos entraînements de plongée, natation et autres activités aquatiques.
            </p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 11l3 3L22 4"></path>
                        <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Gestion des Entraînements</h3>
                <p class="feature-description">
                    Créez, organisez et suivez vos programmes d'entraînement de plongée et natation
                    avec une interface intuitive et professionnelle.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
                <h3 class="feature-title">Planning des Séances</h3>
                <p class="feature-description">
                    Planifiez vos séances en piscine, sorties en milieu naturel et entraînements
                    avec un calendrier maritime intégré.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 00-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 010 7.75"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Suivi des Adhérents</h3>
                <p class="feature-description">
                    Gérez les inscriptions, suivez les progrès de vos plongeurs et nageurs,
                    et maintenez une base de données complète des membres.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="20" x2="12" y2="10"></line>
                        <line x1="18" y1="20" x2="18" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="16"></line>
                    </svg>
                </div>
                <h3 class="feature-title">Statistiques et Rapports</h3>
                <p class="feature-description">
                    Analysez les performances, suivez l'assiduité et générez des rapports
                    détaillés pour optimiser vos entraînements.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">Prêt à plonger dans l'aventure ?</h2>
            <p class="cta-description">
                Rejoignez Lyon Palme dès aujourd'hui et bénéficiez d'une plateforme
                professionnelle pour gérer toutes vos activités aquatiques.
            </p>
            @guest
                <div class="hero-cta">
                    <a href="{{ route('register') }}" class="hero-button">
                        S'inscrire maintenant
                    </a>
                    <a href="{{ route('login') }}" class="hero-button hero-button-secondary">
                        Se connecter
                    </a>
                </div>
            @else
                <a href="{{ route('dashboard') }}" class="hero-button">
                    Accéder à votre espace
                </a>
            @endguest
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-brand">Lyon Palme</div>
            <p class="footer-description">
                Club de plongée sous-marine et activités aquatiques à Lyon
            </p>
            <div class="footer-links">
                <a href="https://www.lyonpalme.com/" target="_blank" rel="noopener" class="footer-link">
                    Site officiel
                </a>
                <span class="footer-link">
                    contact@lyonpalme.com
                </span>
                <a href="{{ url('/legal/privacy') }}" class="footer-link">
                    Politique de confidentialité
                </a>
                <a href="{{ url('/legal/reglement') }}" class="footer-link">
                    Règlement intérieur
                </a>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright">
                    © {{ date('Y') }} Lyon Palme. Tous droits réservés.
                </p>
            </div>
        </div>
    </div>
</footer>
@endsection
