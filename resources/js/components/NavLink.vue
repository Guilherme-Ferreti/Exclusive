<template>
  <li class="navbar-link hover:text-gray-500">
    <BaseLink
      v-if="icon"
      :href="href"
      :title="label"
    >
      <AppIcon
        :icon="icon"
        :aria-label="label"
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
</style>
