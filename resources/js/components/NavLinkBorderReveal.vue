<template>
  <li>
    <BaseLink
      :href="href"
      class="btn-border-reveal h-full bg-white p-1"
      :title="label"
    >
      {{ label }}
    </BaseLink>
  </li>
</template>

<script setup lang="ts">
import { InertiaLinkProps } from '@inertiajs/vue3';
import BaseLink from './BaseLink.vue';

defineProps<{
  href: InertiaLinkProps['href'];
  label: string;
}>();
</script>
