<template>
  <div v-viewer.static="{ navbar: false, toolbar: { zoomIn: true, zoomOut: true }, url: 'data-detail' }">
    <img
      v-bind="$attrs"
      :src="src"
      :alt="alt"
      :data-detail="detailUrl"
      class="cursor-zoom-in object-contain transition-transform duration-300 hover:scale-105"
      loading="lazy"
    />
  </div>
</template>

<script setup lang="ts">
defineProps<{
  src: string;
  alt: string;
  detailUrl: string;
}>();

defineOptions({
  inheritAttrs: false,
});
</script>
