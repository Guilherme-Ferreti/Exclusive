<template>
  <div class="flex flex-col items-center justify-center space-y-1.5 py-1 text-center">
    <div
      v-if="icon"
      class="text-gray-400 flex h-3 w-3 items-center justify-center rounded-full bg-gray-100"
    >
      <AppIcon :icon="icon" />
    </div>
    <h3
      v-if="title"
      class="text-gray-900 text-lg font-semibold"
    >
      {{ title }}
    </h3>
    <p
      v-if="description"
      class="max-w-[80ch] text-gray-500"
    >
      {{ description }}
    </p>
    <div
      v-if="$slots.action"
      class="mt-2"
    >
      <slot name="action" />
    </div>
  </div>
</template>

<script setup lang="ts">
import { type Icon } from '@tabler/icons-vue';
import AppIcon from './AppIcon.vue';

defineProps<{
  title: string;
  description?: string;
  icon?: Icon;
}>();
</script>
