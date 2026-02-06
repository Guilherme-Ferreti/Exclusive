<template>
  <div class="flex items-center gap-1">
    <div class="h-2.5 w-1.25 rounded-sm bg-red-500"></div>
    <span class="font-semibold text-red-500">{{ text }}</span>
  </div>
</template>

<script setup lang="ts">
defineProps<{
  text: string;
}>();
</script>
