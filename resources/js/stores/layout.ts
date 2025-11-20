import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useLayoutStore = defineStore('layout-store', () => {
  const overlayIsVisible = ref(false);

  function showOverlay() {
    overlayIsVisible.value = true;
    document.body.style.overflow = 'hidden';
  }

  function hideOverlay() {
    overlayIsVisible.value = false;
    document.body.style.overflow = 'auto';
  }

  return {
    overlayIsVisible,
    showOverlay,
    hideOverlay,
  };
});
