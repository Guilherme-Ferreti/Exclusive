<template>
  <label class="block">{{ content }}</label>
</template>

<script setup lang="ts">
defineProps<{
  content: string;
}>();
</script>
