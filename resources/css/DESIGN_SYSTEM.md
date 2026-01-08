Design System — Lyon Palme

But de ce document
- Expliquer où sont les tokens et comment les utiliser
- Donner des exemples d'usage (classes utilitaires et composants)

Fichiers importants
- `resources/css/lyonpalme.tokens.css` : variables CSS du thème (couleurs, rayon, ombres)
- `resources/css/app.css` : importe les tokens et contient les styles globaux
- `tailwind.config.cjs` : configuration Tailwind (si utilisé)

Usage des tokens
- Couleur de brand : `var(--lp-teal)` ou `var(--lp-amber)`
- Fond carte : `var(--lp-card)`
- Bordure : `var(--lp-border)`
- Rayon : `var(--lp-radius)`

Exemples rapides
- Bouton principal
  ```css
  .btn-primary {
    background: var(--lp-teal);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: var(--lp-radius);
  }
  ```

- Carte
  ```css
  .card {
    background: var(--lp-card);
    border: 1px solid var(--lp-border);
    border-radius: var(--lp-radius);
    box-shadow: var(--lp-shadow);
  }
  ```

Bonnes pratiques
- Préférer les variables (`var(--...)`) dans les composants pour faciliter le theming.
- Rendre les composants accessibles (contraste, focus visible).
- Travailler mobile-first et utiliser le responsive design pour les tableaux/plannings.

Prochaine étape
- Ajouter des tokens typographiques (taille, graisse) et un set de composants réutilisables en Vue.
