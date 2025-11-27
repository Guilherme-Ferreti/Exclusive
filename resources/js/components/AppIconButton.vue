<template>
  <button
    :type="type"
    class="cursor-pointer"
  >
    <AppIcon :icon="icon" />
  </button>
</template>

<script setup lang="ts">
import { type Icon } from '@tabler/icons-vue';
import AppIcon from './AppIcon.vue';

defineProps<{
  type: HTMLButtonElement['type'];
  icon: Icon;
}>();
</script>
