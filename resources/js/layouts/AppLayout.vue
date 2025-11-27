<template>
  <AppOverlay />
  <header class="app-container | border-b border-gray-300 py-1">
    <TheMobileNavbar />
    <TheDesktopNavbar />
  </header>
  <main class="app-container my-3.75">
    <slot />
  </main>
</template>

<script setup lang="ts">
import AppOverlay from '@/components/AppOverlay.vue';
import TheDesktopNavbar from '@/components/TheDesktopNavbar.vue';
import TheMobileNavbar from '@/components/TheMobileNavbar.vue';
</script>
