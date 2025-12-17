<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Règlement Intérieur - Lyon Palme</title>
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
            background: var(--gradient-deep);
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
            border-bottom: 2px solid var(--brand-amber);
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
        .safety-highlight {
            background: var(--danger-bg);
            border: 2px solid var(--danger);
            color: var(--danger);
            padding: 1rem;
            border-radius: var(--radius);
            margin: 1rem 0;
            font-weight: 600;
        }
        .important-highlight {
            background: var(--warning-bg);
            border: 2px solid var(--warning);
            color: var(--brand-amber);
            padding: 1rem;
            border-radius: var(--radius);
            margin: 1rem 0;
        }
        .info-highlight {
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
        .article-number {
            font-weight: 700;
            color: var(--brand-teal);
        }
        .sub-section {
            margin-left: 1rem;
            padding-left: 1rem;
            border-left: 2px solid var(--border);
        }
    </style>
</head>
<body>
    <div class="legal-container">
        <a href="{{ route('welcome') }}" class="button button-secondary back-button">
            ← Retour à l'accueil
        </a>

        <div class="legal-header">
            <h1 class="legal-title">📋 Règlement Intérieur</h1>
            <p>Lyon Palme - Club de Natation et Plongée</p>
            <p style="font-size: 0.875rem; opacity: 0.9;">Version en vigueur : 17 décembre 2025</p>
        </div>

        <div class="legal-content">
            <div class="info-highlight">
                <p><strong>Le présent règlement intérieur définit les règles de fonctionnement du club Lyon Palme.</strong> Tout membre s'engage à le respecter lors de son adhésion.</p>
            </div>

            <h2 class="section-title">Article 1 - Objet et Mission du Club</h2>
            <p class="legal-text"><span class="article-number">1.1.</span> Lyon Palme a pour objet la pratique et le développement de la natation et de la plongée sous-marine.</p>
            <p class="legal-text"><span class="article-number">1.2.</span> Le club propose des activités pour tous niveaux : apprentissage, perfectionnement, compétition et loisir.</p>
            <p class="legal-text"><span class="article-number">1.3.</span> Lyon Palme promeut les valeurs de respect, solidarité, dépassement de soi et sécurité aquatique.</p>

            <h2 class="section-title">Article 2 - Adhésion et Cotisation</h2>
            <p class="legal-text"><span class="article-number">2.1.</span> L'adhésion est ouverte à toute personne majeure ou mineure (avec autorisation parentale).</p>
            <p class="legal-text"><span class="article-number">2.2.</span> La cotisation annuelle est fixée par l'assemblée générale et doit être réglée intégralement.</p>
            <p class="legal-text"><span class="article-number">2.3.</span> Pièces obligatoires :</p>
            <ul class="legal-list">
                <li>Certificat médical de non contre-indication à la pratique aquatique</li>
                <li>Attestation de savoir nager (25m minimum)</li>
                <li>Justificatif d'identité et de domicile</li>
                <li>Autorisation parentale pour les mineurs</li>
                <li>Photo d'identité récente</li>
            </ul>

            <div class="important-highlight">
                <p><strong>⚠️ Important :</strong> Aucune participation aux activités n'est possible sans certificat médical à jour et attestation de natation.</p>
            </div>

            <h2 class="section-title">Article 3 - Sécurité et Règles Aquatiques</h2>
            
            <div class="safety-highlight">
                <p><strong>🚨 SÉCURITÉ PRIORITAIRE :</strong> La sécurité est la priorité absolue de Lyon Palme. Le non-respect des règles de sécurité entraîne l'exclusion immédiate.</p>
            </div>

            <div class="sub-section">
                <h3 style="color: var(--brand-navy); font-size: 1.25rem; margin: 1.5rem 0 1rem 0;">3.1 - Règles Générales</h3>
                <ul class="legal-list">
                    <li>Port du bonnet de bain obligatoire</li>
                    <li>Passage obligatoire sous la douche avant d'entrer dans l'eau</li>
                    <li>Interdiction de courir sur les plages de piscine</li>
                    <li>Respect des créneaux horaires et des couloirs de nage</li>
                    <li>Matériel personnel marqué au nom du propriétaire</li>
                </ul>

                <h3 style="color: var(--brand-navy); font-size: 1.25rem; margin: 1.5rem 0 1rem 0;">3.2 - Plongée Sous-Marine</h3>
                <ul class="legal-list">
                    <li>Plongée interdite sans encadrement qualifié</li>
                    <li>Vérification obligatoire du matériel avant chaque plongée</li>
                    <li>Respect des procédures de décompression et paliers</li>
                    <li>Binôme obligatoire - jamais de plongée seul</li>
                    <li>Carnet de plongée à jour obligatoire</li>
                </ul>

                <h3 style="color: var(--brand-navy); font-size: 1.25rem; margin: 1.5rem 0 1rem 0;">3.3 - Urgences et Premiers Secours</h3>
                <ul class="legal-list">
                    <li>En cas d'accident, prévenir immédiatement l'encadrement</li>
                    <li>Numéros d'urgence affichés dans tous les locaux</li>
                    <li>Trousse de premiers secours disponible en permanence</li>
                    <li>Protocole d'évacuation affiché et à connaître</li>
                </ul>
            </div>

            <h2 class="section-title">Article 4 - Comportement et Vie Club</h2>
            <p class="legal-text"><span class="article-number">4.1.</span> Chaque membre doit adopter un comportement respectueux envers les autres membres, l'encadrement et les installations.</p>
            <p class="legal-text"><span class="article-number">4.2.</span> Sont interdits :</p>
            <ul class="legal-list">
                <li>Toute forme de violence physique ou verbale</li>
                <li>Discrimination, harcèlement ou propos déplacés</li>
                <li>Consommation d'alcool ou de substances interdites</li>
                <li>Usage du tabac dans les locaux et zones couvertes</li>
                <li>Utilisation d'appareils photo/vidéo sans autorisation</li>
            </ul>

            <p class="legal-text"><span class="article-number">4.3.</span> Le fair-play et l'esprit d'équipe sont des valeurs fondamentales du club.</p>

            <h2 class="section-title">Article 5 - Utilisation des Installations</h2>
            <p class="legal-text"><span class="article-number">5.1.</span> Les installations sont réservées aux membres à jour de cotisation et activités encadrées.</p>
            <p class="legal-text"><span class="article-number">5.2.</span> Horaires d'ouverture :</p>
            <ul class="legal-list">
                <li><strong>Lundi à Vendredi :</strong> 18h00 - 22h00</li>
                <li><strong>Samedi :</strong> 14h00 - 18h00</li>
                <li><strong>Dimanche :</strong> 09h00 - 12h00 (selon activités)</li>
                <li><strong>Vacances scolaires :</strong> horaires modifiés affichés</li>
            </ul>

            <p class="legal-text"><span class="article-number">5.3.</span> Chaque membre est responsable du matériel mis à disposition et de la propreté des locaux.</p>

            <div class="info-highlight">
                <p><strong>💡 Astuce :</strong> Consultez le planning en ligne sur votre espace membre pour connaître les créneaux disponibles et vous inscrire aux séances.</p>
            </div>

            <h2 class="section-title">Article 6 - Encadrement et Formation</h2>
            <p class="legal-text"><span class="article-number">6.1.</span> Tous les entraîneurs sont diplômés et qualifiés selon la réglementation en vigueur.</p>
            <p class="legal-text"><span class="article-number">6.2.</span> Le niveau des groupes est déterminé par l'encadrement technique selon les capacités de chacun.</p>
            <p class="legal-text"><span class="article-number">6.3.</span> Toute contestation concernant l'encadrement doit être adressée par écrit au bureau du club.</p>

            <h2 class="section-title">Article 7 - Sanctions Disciplinaires</h2>
            <p class="legal-text">En cas de manquement au règlement, les sanctions suivantes peuvent être appliquées :</p>
            <ul class="legal-list">
                <li><strong>Avertissement oral</strong> pour les infractions mineures</li>
                <li><strong>Avertissement écrit</strong> consigné dans le dossier membre</li>
                <li><strong>Suspension temporaire</strong> de 1 semaine à 3 mois</li>
                <li><strong>Exclusion définitive</strong> pour faute grave ou récidive</li>
            </ul>

            <div class="safety-highlight">
                <p><strong>⚠️ Faute grave entraînant l'exclusion immédiate :</strong> Mise en danger d'autrui, violence, vol, non-respect des règles de sécurité aquatique.</p>
            </div>

            <h2 class="section-title">Article 8 - Assurance et Responsabilité</h2>
            <p class="legal-text"><span class="article-number">8.1.</span> Le club souscrit une assurance responsabilité civile couvrant les activités officielles.</p>
            <p class="legal-text"><span class="article-number">8.2.</span> Chaque membre doit posséder une assurance individuelle accidents corporels.</p>
            <p class="legal-text"><span class="article-number">8.3.</span> Le club décline toute responsabilité pour les objets personnels perdus ou volés.</p>

            <h2 class="section-title">Article 9 - Modifications et Litiges</h2>
            <p class="legal-text"><span class="article-number">9.1.</span> Le présent règlement peut être modifié par le conseil d'administration.</p>
            <p class="legal-text"><span class="article-number">9.2.</span> Les membres sont informés des modifications par email et affichage.</p>
            <p class="legal-text"><span class="article-number">9.3.</span> En cas de litige, seuls les tribunaux de Lyon sont compétents.</p>

            <div class="important-highlight">
                <p style="text-align: center; margin: 0;"><strong>📝 En adhérant à Lyon Palme, vous vous engagez à respecter l'intégralité de ce règlement intérieur.</strong></p>
            </div>

            <div style="margin-top: 2rem; padding: 1rem; background: var(--bg-ocean); border-radius: var(--radius); text-align: center;">
                <p style="margin: 0; color: var(--text-muted); font-size: 0.875rem;">
                    <strong>Contact Bureau :</strong> bureau@lyonpalme.fr | <strong>Urgences :</strong> [Numéro d'urgence du club]
                </p>
            </div>
        </div>

        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ route('welcome') }}" class="button button-primary">
                🏠 Retour à l'accueil
            </a>
            <a href="{{ route('privacy') }}" class="button button-secondary" style="margin-left: 1rem;">
                🔒 Politique de confidentialité
            </a>
        </div>
    </div>
</body>
</html>
