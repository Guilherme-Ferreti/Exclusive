<template>
  <div class="flex flex-col items-center justify-center">
    <div class="text-gray-400 flex size-3 items-center justify-center">
      <div class="animate-spin">
        <AppIcon :icon="icon ?? IconLoader2" />
      </div>
    </div>
    <p
      v-if="message"
      class="text-gray-500"
    >
      {{ message }}
    </p>
  </div>
</template>

<script setup lang="ts">
import { IconLoader2, type Icon } from '@tabler/icons-vue';
import AppIcon from './AppIcon.vue';

defineProps<{
  message?: string;
  icon?: Icon;
}>();
</script>
