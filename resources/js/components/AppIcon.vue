<template>
  <component
    :is="icon"
    size="2rem"
    stroke="1.5"
    role="presentation"
  />
</template>

<script setup lang="ts">
import { type Icon } from '@tabler/icons-vue';

defineProps<{
  icon: Icon;
}>();
</script>
