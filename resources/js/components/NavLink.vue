<template>
  <li class="navbar-link hover:text-gray-500">
    <BaseLink
      v-if="icon"
      :href="href"
      :title="label"
    >
      <AppIcon
        :icon="icon"
        role="presentation"
      />
    </BaseLink>
    <BaseLink
      v-else
      :href="href"
    >
      {{ label }}
    </BaseLink>
  </li>
</template>

<script setup lang="ts">
import { InertiaLinkProps } from '@inertiajs/vue3';
import { type Icon } from '@tabler/icons-vue';
import AppIcon from './AppIcon.vue';
import BaseLink from './BaseLink.vue';

defineProps<{
  href: InertiaLinkProps['href'];
  label: string;
  icon?: Icon;
}>();
</script>

<style scoped>
@reference 'tailwindcss';

.navbar-link:has(a[aria-current='page']):not(:has(.tabler-icon)) {
  @apply border-b;
}

.navbar-link:has(.tabler-icon) a {
  @apply flex size-2.5 items-center justify-center rounded-full;
}

.navbar-link:has(a[aria-current='page']):has(.tabler-icon) a {
  @apply bg-red-500 text-white hover:bg-red-300;
}
</style>
