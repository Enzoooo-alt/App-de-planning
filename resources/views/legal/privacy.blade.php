<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique de Confidentialité - Lyon Palme</title>
    @vite(['resources/css/lyon-palme.css'])
    <style>
        body {
            background: var(--bg-secondary);
            line-height: 1.7;
        }
        .legal-container {
            max-width: 48rem;
            margin: 0 auto;
            padding: 2rem 1rem;
        }
        .legal-header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem;
            background: var(--gradient-ocean);
            border-radius: var(--radius-lg);
            color: white;
        }
        .legal-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }
        .legal-content {
            background: var(--bg-primary);
            padding: 3rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
        }
        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--brand-navy);
            margin: 2rem 0 1rem 0;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--brand-teal);
        }
        .section-title:first-of-type {
            margin-top: 0;
        }
        .legal-text {
            color: var(--text-secondary);
            margin-bottom: 1rem;
        }
        .legal-list {
            padding-left: 1.5rem;
            color: var(--text-secondary);
        }
        .legal-list li {
            margin-bottom: 0.5rem;
        }
        .highlight {
            background: var(--bg-ocean);
            padding: 1rem;
            border-radius: var(--radius);
            border-left: 3px solid var(--brand-teal);
            margin: 1rem 0;
        }
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }
        .contact-info {
            background: var(--bg-ocean);
            padding: 1.5rem;
            border-radius: var(--radius);
            margin: 2rem 0;
        }
    </style>
</head>
<body>
    <div class="legal-container">
        <a href="{{ route('welcome') }}" class="button button-secondary back-button">
            ← Retour à l'accueil
        </a>

        <div class="legal-header">
            <h1 class="legal-title">🔒 Politique de Confidentialité</h1>
            <p>Lyon Palme - Club de Natation et Plongée</p>
            <p style="font-size: 0.875rem; opacity: 0.9;">Dernière mise à jour : 17 décembre 2025</p>
        </div>

        <div class="legal-content">
            <div class="highlight">
                <p><strong>Lyon Palme</strong> s'engage à protéger et respecter votre vie privée. Cette politique explique comment nous collectons, utilisons et protégeons vos données personnelles.</p>
            </div>

            <h2 class="section-title">1. Données Collectées</h2>
            <p class="legal-text">Nous collectons les informations suivantes :</p>
            <ul class="legal-list">
                <li><strong>Informations d'identification :</strong> nom, prénom, adresse email</li>
                <li><strong>Informations de contact :</strong> numéro de téléphone, adresse postale</li>
                <li><strong>Informations d'adhésion :</strong> niveau de natation, certifications de plongée</li>
                <li><strong>Données de participation :</strong> présence aux séances, performances</li>
                <li><strong>Informations techniques :</strong> adresse IP, cookies de session</li>
            </ul>

            <h2 class="section-title">2. Utilisation des Données</h2>
            <p class="legal-text">Vos données sont utilisées pour :</p>
            <ul class="legal-list">
                <li>Gérer votre adhésion et votre compte membre</li>
                <li>Organiser les séances d'entraînement et les activités</li>
                <li>Communiquer des informations importantes du club</li>
                <li>Assurer la sécurité lors des activités aquatiques</li>
                <li>Améliorer nos services et programmes d'entraînement</li>
            </ul>

            <h2 class="section-title">3. Protection des Données</h2>
            <p class="legal-text">Nous mettons en place des mesures de sécurité appropriées :</p>
            <ul class="legal-list">
                <li>Chiffrement des mots de passe et données sensibles</li>
                <li>Accès limité aux données selon les rôles (président, entraîneur, membre)</li>
                <li>Serveurs sécurisés et connexions HTTPS</li>
                <li>Sauvegardes régulières et sécurisées</li>
                <li>Formation du personnel sur la protection des données</li>
            </ul>

            <h2 class="section-title">4. Partage des Données</h2>
            <p class="legal-text">Vos données ne sont jamais vendues. Elles peuvent être partagées uniquement :</p>
            <ul class="legal-list">
                <li>Avec les entraîneurs pour le suivi pédagogique</li>
                <li>Avec les autorités compétentes si requis par la loi</li>
                <li>Avec les services de secours en cas d'urgence</li>
                <li>Avec la fédération de natation pour les compétitions officielles</li>
            </ul>

            <h2 class="section-title">5. Vos Droits</h2>
            <p class="legal-text">Conformément au RGPD, vous disposez des droits suivants :</p>
            <ul class="legal-list">
                <li><strong>Accès :</strong> consulter vos données personnelles</li>
                <li><strong>Rectification :</strong> corriger les informations inexactes</li>
                <li><strong>Effacement :</strong> supprimer vos données sous conditions</li>
                <li><strong>Portabilité :</strong> récupérer vos données dans un format lisible</li>
                <li><strong>Opposition :</strong> vous opposer au traitement de vos données</li>
                <li><strong>Limitation :</strong> demander la limitation du traitement</li>
            </ul>

            <div class="highlight">
                <p><strong>⚠️ Important pour la sécurité aquatique :</strong> Certaines données (certifications, niveau de natation, problèmes de santé) sont conservées pour des raisons de sécurité même après résiliation de l'adhésion.</p>
            </div>

            <h2 class="section-title">6. Cookies et Technologies</h2>
            <p class="legal-text">Notre site utilise :</p>
            <ul class="legal-list">
                <li><strong>Cookies de session :</strong> pour maintenir votre connexion</li>
                <li><strong>Cookies de préférences :</strong> pour mémoriser vos paramètres</li>
                <li><strong>Cookies de sécurité :</strong> pour protéger contre les attaques</li>
            </ul>
            <p class="legal-text">Vous pouvez désactiver les cookies dans votre navigateur, mais certaines fonctionnalités pourraient être limitées.</p>

            <h2 class="section-title">7. Conservation des Données</h2>
            <p class="legal-text">Nous conservons vos données :</p>
            <ul class="legal-list">
                <li><strong>Données d'adhésion :</strong> pendant la durée d'adhésion + 3 ans</li>
                <li><strong>Données de sécurité :</strong> 10 ans (réglementation aquatique)</li>
                <li><strong>Données comptables :</strong> 10 ans (obligation légale)</li>
                <li><strong>Données de communication :</strong> 3 ans maximum</li>
            </ul>

            <div class="contact-info">
                <h3 style="color: var(--brand-teal); margin-bottom: 1rem;">📧 Contact - Protection des Données</h3>
                <p style="margin: 0.5rem 0;"><strong>Email :</strong> privacy@lyonpalme.fr</p>
                <p style="margin: 0.5rem 0;"><strong>Courrier :</strong> Lyon Palme - DPO<br>
                [Adresse du club]<br>
                69000 Lyon</p>
                <p style="margin: 0.5rem 0;"><strong>Délai de réponse :</strong> 30 jours maximum</p>
            </div>

            <h2 class="section-title">8. Modifications</h2>
            <p class="legal-text">Cette politique peut être mise à jour. Les changements significatifs vous seront notifiés par email ou via le site web. La date de dernière modification est indiquée en haut de cette page.</p>

            <div class="highlight">
                <p style="text-align: center; margin: 0;"><strong>En utilisant notre site et nos services, vous acceptez cette politique de confidentialité.</strong></p>
            </div>
        </div>

        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ route('welcome') }}" class="button button-primary">
                🏠 Retour à l'accueil
            </a>
            <a href="{{ route('reglement') }}" class="button button-secondary" style="margin-left: 1rem;">
                📋 Voir le règlement intérieur
            </a>
        </div>
    </div>
</body>
</html>
