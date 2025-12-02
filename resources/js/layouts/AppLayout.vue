<template>
  <AppOverlay />
  <header class="app-container | h-4.5 border-b border-gray-300 py-1">
    <TheMobileNavbar />
    <TheDesktopNavbar />
  </header>
  <main class="app-container my-3.75 min-h-[calc(100vh-(--spacing(4.5)))]">
    <slot />
  </main>
  <TheFooter />
</template>

<script setup lang="ts">
import AppOverlay from '@/components/AppOverlay.vue';
import TheDesktopNavbar from '@/components/TheDesktopNavbar.vue';
import TheFooter from '@/components/TheFooter.vue';
import TheMobileNavbar from '@/components/TheMobileNavbar.vue';
</script>
