<template>
  <div
    class="fixed inset-0 z-10 h-screen bg-black opacity-50"
    :class="{
      block: overlayIsVisible,
      hidden: !overlayIsVisible,
    }"
    aria-hidden="true"
  ></div>
</template>

<script setup lang="ts">
import { useLayoutStore } from '@/stores/layout';
import { toRefs } from 'vue';

const { overlayIsVisible } = toRefs(useLayoutStore());
</script>
