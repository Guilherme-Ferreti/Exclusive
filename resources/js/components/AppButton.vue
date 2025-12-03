<template>
  <button
    :type="type"
    class="inline-flex h-3 cursor-pointer items-center justify-center gap-1 rounded-sm px-3 font-medium outline-offset-2"
    :class="{
      'bg-red-500 text-white hover:bg-red-300 disabled:bg-red-300': variant === ButtonVariant.primary,
    }"
  >
    <AppIcon
      v-if="iconLeft"
      :icon="iconLeft"
    />
    <span>{{ label }}</span>
    <AppIcon
      v-if="iconRight"
      :icon="iconRight"
    />
  </button>
</template>

<script lang="ts">
enum ButtonVariant {
  primary = 'primary',
}
</script>

<script setup lang="ts">
import { type Icon } from '@tabler/icons-vue';
import AppIcon from './AppIcon.vue';

defineProps<{
  type: HTMLButtonElement['type'];
  variant: `${ButtonVariant}`;
  iconLeft?: Icon;
  iconRight?: Icon;
  label?: string;
}>();
</script>
