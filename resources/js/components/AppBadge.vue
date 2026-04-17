<template>
  <span
    class="app-badge"
    :data-color="color"
    >{{ label }}</span
  >
</template>

<script setup lang="ts">
defineProps<{
  label: string;
  color: App.Enums.BadgeColor;
}>();
</script>

<style scoped>
@reference 'tailwindcss';

.app-badge {
  @apply inline-block rounded-full px-1.5 py-0.5 text-xs font-medium capitalize;
}

.app-badge[data-color='yellow'] {
  @apply bg-yellow-100 text-yellow-800;
}

.app-badge[data-color='blue'] {
  @apply bg-blue-100 text-blue-800;
}

.app-badge[data-color='green'] {
  @apply bg-green-100 text-green-800;
}
</style>
