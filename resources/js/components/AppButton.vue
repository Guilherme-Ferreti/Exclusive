<template>
  <component
    :is="href ? BaseLink : 'button'"
    :type="type"
    :data-variant="variant"
    :href="href"
    :title="label"
    class="app-button"
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
  </component>
</template>

<script lang="ts">
interface AppButtonProps {
  type?: HTMLButtonElement['type'];
  href?: InertiaLinkProps['href'];
  variant?: `${ButtonVariant}`;
  iconLeft?: Icon;
  iconRight?: Icon;
  label?: string;
}

enum ButtonVariant {
  primary = 'primary',
}
</script>

<script setup lang="ts">
import { InertiaLinkProps } from '@inertiajs/vue3';
import { type Icon } from '@tabler/icons-vue';
import AppIcon from './AppIcon.vue';
import BaseLink from './BaseLink.vue';

withDefaults(defineProps<AppButtonProps>(), {
  type: 'button',
  variant: 'primary',
});
</script>

<style scoped>
@reference 'tailwindcss';

.app-button {
  @apply inline-flex h-3 cursor-pointer items-center justify-center gap-1 rounded-sm px-3 font-medium outline-offset-2;
}

.app-button[data-variant='primary'] {
  @apply bg-red-500 text-white hover:bg-red-300 disabled:bg-red-300;
}
</style>
