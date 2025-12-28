<template>
  <ul class="flex h-fit items-center gap-0.5 text-sm text-gray-500">
    <li
      v-for="breadcrumb in breadcrumbs"
      :key="breadcrumb.name"
      class="not-first:before:mr-0.5 not-first:before:inline-block not-first:before:text-xs not-first:before:content-['/']"
    >
      <span
        :class="{
          'text-black': breadcrumb.isActive,
        }"
      >
        <BaseLink
          v-if="breadcrumb.href"
          :href="breadcrumb.href"
          :title="breadcrumb.name"
          >{{ breadcrumb.name }}</BaseLink
        >
        <template v-else>{{ breadcrumb.name }}</template>
      </span>
    </li>
  </ul>
</template>

<script lang="ts">
interface Breadcrumb {
  name: string;
  href?: RouteDefinition<'get'>;
  isActive?: boolean;
}
</script>

<script setup lang="ts">
import { RouteDefinition } from '@/wayfinder';
import BaseLink from './BaseLink.vue';

defineProps<{
  breadcrumbs: Breadcrumb[];
}>();
</script>
