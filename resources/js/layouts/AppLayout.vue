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
import { router } from '@inertiajs/vue3';
import { onUnmounted } from 'vue';
import { useToast } from 'vue-toastification';

const toast = useToast();

const removeFlashEventListener = router.on('flash', (event) => {
  if (event.detail.flash.toast) {
    toast(event.detail.flash.toast.message, {
      type: event.detail.flash.toast.type,
    });
  }
});

onUnmounted(() => removeFlashEventListener());
</script>
