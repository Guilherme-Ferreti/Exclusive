<template>
  <p
    v-if="content"
    class="text-sm text-red-500"
  >
    {{ content }}
  </p>
</template>

<script setup lang="ts">
defineProps<{
  content: string;
}>();
</script>
