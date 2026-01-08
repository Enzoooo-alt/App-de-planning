<template>
  <div>
    <h1 class="h1">Bienvenue sur Lyon Palme</h1>
    <p class="subtitle">Plateforme de gestion des activités aquatiques — Dashboard simplifié.</p>

    <div class="cards mt-6">
      <div class="card">
        <h2>Entrées rapides</h2>
        <p class="meta">Accédez aux entraînements, adhérents et profils.</p>
      </div>
      <div class="card">
        <h2>Design System</h2>
        <p class="meta">Les tokens sont définis dans <code>resources/css/lyonpalme.tokens.css</code>.</p>
      </div>
    </div>
  </div>
</template>

<script>
import DefaultLayout from '../Layouts/DefaultLayout.vue';

export default {
  name: 'Home',
  layout: DefaultLayout,
};
</script>

<style scoped>
.subtitle { color: var(--text-muted); max-width: 60ch; }
.cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem; }
</style>
