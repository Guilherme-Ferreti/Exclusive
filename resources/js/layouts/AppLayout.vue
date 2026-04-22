<template>
  <AppOverlay />
  <TheSkipToContentLink />
  <div class="min-h-[85vh]">
    <header class="app-container | min-h-4.5 border-b border-gray-300 py-1">
      <TheMobileNavbar />
      <TheDesktopNavbar />
    </header>
    <main
      id="main-content"
      class="app-container my-2.5 gap-y-2.5 md:my-3"
    >
      <slot />
    </main>
  </div>
  <TheFooter />
</template>

<script setup lang="ts">
import AppOverlay from '@/components/AppOverlay.vue';
import TheDesktopNavbar from '@/components/TheDesktopNavbar.vue';
import TheFooter from '@/components/TheFooter.vue';
import TheMobileNavbar from '@/components/TheMobileNavbar.vue';
import TheSkipToContentLink from '@/components/TheSkipToContentLink.vue';
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
