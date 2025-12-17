@extends('layouts.app')

@section('title', 'Politique de Confidentialité - Lyon Palme')

@section('content')
<div class="privacy-container">
    <div class="privacy-card">
        <!-- Header -->
        <div class="privacy-header">
            <h1 class="privacy-logo">Lyon Palme</h1>
            <h2 class="privacy-title">Politique de Confidentialité</h2>
        </div>

        <!-- Content -->
        <div class="privacy-content">
            <!-- Section 1 -->
            <section class="privacy-section">
                <h3 class="section-title">1. Introduction</h3>
                <p class="section-text">
                    Bienvenue sur <strong>Lyon Palme</strong>. La protection de vos données personnelles est une priorité pour nous. 
                    La présente politique de confidentialité explique comment nous collectons, utilisons, partageons et protégeons 
                    vos informations lorsque vous utilisez notre site web et nos services.
                </p>
                <p class="section-text">
                    En vous inscrivant ou en utilisant nos services, vous acceptez les pratiques décrites dans cette politique.
                </p>
            </section>

            <!-- Section 2 -->
            <section class="privacy-section">
                <h3 class="section-title">2. Informations que nous collectons</h3>
                <p class="section-text">
                    Nous pouvons collecter les informations suivantes :
                </p>
                <ul class="privacy-list">
                    <li><strong>Informations d'identification</strong> : nom complet, adresse e-mail, mot de passe.</li>
                    <li><strong>Données de connexion</strong> : adresse IP, type de navigateur, pages consultées, horaires d'accès.</li>
                    <li><strong>Données de transaction</strong> : si applicable, informations relatives aux achats ou abonnements.</li>
                    <li><strong>Cookies et technologies similaires</strong> : pour améliorer votre expérience et analyser l'usage du site.</li>
                </ul>
            </section>

            <!-- Section 3 -->
            <section class="privacy-section">
                <h3 class="section-title">3. Utilisation des informations</h3>
                <p class="section-text">
                    Nous utilisons vos données pour :
                </p>
                <ul class="privacy-list">
                    <li>Créer et gérer votre compte.</li>
                    <li>Vous fournir nos services et fonctionnalités.</li>
                    <li>Vous envoyer des informations importantes (modifications de compte, mises à jour).</li>
                    <li>Améliorer notre site et personnaliser votre expérience.</li>
                    <li>Respecter nos obligations légales.</li>
                </ul>
            </section>

            <!-- Section 4 -->
            <section class="privacy-section">
                <h3 class="section-title">4. Partage des informations</h3>
                <p class="section-text">
                    Nous ne vendons pas vos données personnelles. Nous pouvons les partager uniquement dans les cas suivants :
                </p>
                <ul class="privacy-list">
                    <li>Avec votre consentement.</li>
                    <li>Avec des prestataires de services qui nous aident à fonctionner (hébergement, support technique).</li>
                    <li>Pour respecter une obligation légale ou protéger nos droits.</li>
                </ul>
            </section>

            <!-- Section 5 -->
            <section class="privacy-section">
                <h3 class="section-title">5. Sécurité des données</h3>
                <p class="section-text">
                    Nous mettons en œuvre des mesures de sécurité techniques et organisationnelles pour protéger 
                    vos informations contre tout accès non autorisé, perte ou divulgation.
                </p>
            </section>

            <!-- Section 6 -->
            <section class="privacy-section">
                <h3 class="section-title">6. Vos droits</h3>
                <p class="section-text">
                    Conformément au RGPD et aux lois applicables, vous avez le droit :
                </p>
                <ul class="privacy-list">
                    <li>D'accéder à vos données.</li>
                    <li>De les rectifier ou les supprimer.</li>
                    <li>De vous opposer à leur traitement.</li>
                    <li>De retirer votre consentement à tout moment.</li>
                    <li>De demander la portabilité de vos données.</li>
                </ul>
                <p class="section-text">
                    Pour exercer ces droits, contactez-nous à : <strong>contact@lyonpalme.fr</strong>.
                </p>
            </section>

            <!-- Section 7 -->
            <section class="privacy-section">
                <h3 class="section-title">7. Cookies</h3>
                <p class="section-text">
                    Nous utilisons des cookies pour faciliter la navigation et analyser l'audience. 
                    Vous pouvez configurer votre navigateur pour refuser les cookies, mais certaines 
                    fonctionnalités du site pourraient en être affectées.
                </p>
            </section>

            <!-- Section 8 -->
            <section class="privacy-section">
                <h3 class="section-title">8. Modifications de cette politique</h3>
                <p class="section-text">
                    Nous pouvons mettre à jour cette politique de confidentialité. Toute modification 
                    sera publiée sur cette page avec une date de mise à jour révisée.
                </p>
            </section>

         

            <!-- Footer -->
            <div class="privacy-footer">
                <p class="thank-you">Merci de votre confiance.</p>
                <div class="privacy-actions">
                    <a href="{{ route('register') }}" class="btn-back">
                        ← Retour à l'inscription
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.privacy-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding: 2rem 1rem;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.privacy-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    max-width: 900px;
    width: 100%;
    padding: 2.5rem;
    margin: 2rem 0;
}

.privacy-header {
    text-align: center;
    margin-bottom: 2.5rem;
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 1.5rem;
}

.privacy-logo {
    color: #2c3e50;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.privacy-title {
    color: #3498db;
    font-size: 1.8rem;
    margin-bottom: 0.5rem;
}

.privacy-date {
    color: #7f8c8d;
    font-size: 0.9rem;
}

.privacy-content {
    line-height: 1.6;
}

.privacy-section {
    margin-bottom: 2.5rem;
}

.section-title {
    color: #2c3e50;
    font-size: 1.3rem;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #ecf0f1;
}

.section-text {
    color: #34495e;
    margin-bottom: 1rem;
    text-align: justify;
}

.privacy-list {
    list-style-type: none;
    padding-left: 1.5rem;
    margin: 1rem 0;
}

.privacy-list li {
    margin-bottom: 0.5rem;
    position: relative;
    color: #34495e;
}

.privacy-list li:before {
    content: "•";
    color: #3498db;
    font-weight: bold;
    display: inline-block;
    width: 1em;
    margin-left: -1em;
}

.contact-info {
    background: #f8f9fa;
    border-left: 4px solid #3498db;
    padding: 1.5rem;
    border-radius: 8px;
    margin-top: 1rem;
}

.contact-info p {
    margin-bottom: 0.5rem;
    color: #2c3e50;
}

.privacy-footer {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 2px solid #f0f0f0;
    text-align: center;
}

.thank-you {
    font-size: 1.1rem;
    color: #2c3e50;
    font-style: italic;
    margin-bottom: 1.5rem;
}

.privacy-actions {
    display: flex;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn-back {
    background: #3498db;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-back:hover {
    background: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
}

.btn-dashboard {
    background: #2ecc71;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-dashboard:hover {
    background: #27ae60;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(46, 204, 113, 0.3);
}

.btn-back {
    background: #3498db;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}


/* Responsive */
@media (max-width: 768px) {
    .privacy-card {
        padding: 1.5rem;
    }
    
    .privacy-logo {
        font-size: 2rem;
    }
    
    .privacy-title {
        font-size: 1.5rem;
    }
    
    .privacy-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-back, .btn-dashboard {
        width: 100%;
        max-width: 250px;
        text-align: center;
    }
}
</style>
@endsection