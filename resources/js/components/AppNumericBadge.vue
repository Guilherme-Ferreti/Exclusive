<template>
  <span
    class="absolute top-0 right-0 min-h-1.25 min-w-1.25 rounded-full bg-red-500 p-0.25 text-center text-xs leading-none font-semibold text-white"
    >{{ number }}</span
  >
</template>

<script lang="ts" setup>
defineProps<{
  number: number;
}>();
</script>
