<template>
  <div>
    <SiteHeader />
    <main class="container mt-6">
      <slot />
    </main>
  </div>
</template>

<script>
export default {
  name: 'DefaultLayout',
};
</script>

<style scoped>
.container { padding-top: 1rem; }
</style>
