<template>
  <component
    :is="href ? BaseLink : 'button'"
    :href="href"
    :type="type"
    :class="[
      'cursor-pointer',
      variant === 'secondary' ? 'flex items-center justify-center rounded-full bg-gray-300 hover:text-gray-500' : '',
      variant === 'white' ? 'flex items-center justify-center rounded-full bg-white hover:text-gray-500' : '',
      size === 'sm' ? 'size-2' : '',
      size === 'md' ? 'size-2.5' : '',
      size === 'lg' ? 'size-3' : '',
    ]"
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
}
</script>

<script setup lang="ts">
import { InertiaLinkProps } from '@inertiajs/vue3';
import { type Icon } from '@tabler/icons-vue';
import AppIcon from './AppIcon.vue';
import BaseLink from './BaseLink.vue';

withDefaults(defineProps<AppIconButtonProps>(), {
  type: 'button',
  variant: 'secondary',
  size: 'md',
});
</script>
