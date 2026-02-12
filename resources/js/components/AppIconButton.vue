<template>
  <component
    :is="href ? BaseLink : 'button'"
    :href="href"
    :type="type"
    class="app-icon-button"
    :data-variant="variant"
    :data-size="size"
    :data-shape="shape"
  >
    <AppIcon :icon="icon" />
  </component>
</template>

<script lang="ts">
interface AppIconButtonProps {
  icon: Icon;
  type?: HTMLButtonElement['type'];
  href?: InertiaLinkProps['href'];
  variant?: 'secondary' | 'white';
  size?: 'sm' | 'md' | 'lg';
  shape?: 'circle' | 'square';
}
</script>

<script setup lang="ts">
import { InertiaLinkProps } from '@inertiajs/vue3';
import { type Icon } from '@tabler/icons-vue';
import AppIcon from './AppIcon.vue';
import BaseLink from './BaseLink.vue';

withDefaults(defineProps<AppIconButtonProps>(), {
  type: 'button',
  size: 'md',
  shape: 'square',
});
</script>

<style scoped>
@reference 'tailwindcss';

.app-icon-button {
  @apply flex items-center justify-center;

  &:not(:disabled) {
    @apply cursor-pointer;
  }

  &:disabled {
    @apply cursor-auto;
  }

  &[data-variant='secondary'] {
    &:not(:disabled) {
      @apply bg-gray-300 hover:text-gray-500;
    }

    &:disabled {
      @apply bg-gray-100 text-gray-500;
    }
  }

  &[data-variant='white'] {
    &:not(:disabled) {
      @apply bg-white hover:text-gray-500;
    }

    &:disabled {
      @apply text-gray-300;
    }
  }

  &[data-size='sm'] {
    @apply size-2;
  }

  &[data-size='md'] {
    @apply size-2.5;
  }

  &[data-size='lg'] {
    @apply size-3;
  }

  &[data-shape='circle'] {
    @apply rounded-full;
  }

  &[data-shape='square'] {
    @apply rounded-sm;
  }
}
</style>
