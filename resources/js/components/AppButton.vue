<template>
  <button
    :type="type"
    class="cursor-pointer"
  >
    <AppIcon
      v-if="icon"
      :icon="icon"
    />
  </button>
</template>

<script setup lang="ts">
import { Icon } from '@tabler/icons-vue';
import AppIcon from './AppIcon.vue';

defineProps<{
  type: HTMLButtonElement['type'];
  variant: 'ghost';
  icon?: Icon;
}>();
</script>
