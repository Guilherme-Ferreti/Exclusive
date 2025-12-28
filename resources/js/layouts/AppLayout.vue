<template>
  <AppOverlay />
  <div class="flex h-screen flex-col">
    <header class="app-container | h-4.5 border-b border-gray-300 py-1">
      <TheMobileNavbar />
      <TheDesktopNavbar />
    </header>
    <main class="app-container my-3.75">
      <slot />
    </main>
    <TheFooter class="mt-auto" />
  </div>
</template>

<script setup lang="ts">
import AppOverlay from '@/components/AppOverlay.vue';
import TheDesktopNavbar from '@/components/TheDesktopNavbar.vue';
import TheFooter from '@/components/TheFooter.vue';
import TheMobileNavbar from '@/components/TheMobileNavbar.vue';
</script>
