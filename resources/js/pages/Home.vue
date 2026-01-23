<template>
  <section class="md:-mt-3.75 md:flex md:flex-row-reverse md:items-start md:justify-between">
    <div class="mb-3 md:mb-0 md:pt-2.5 md:pl-2.5">
      <img
        src="https://placehold.co/892x344/000000/FFFFFF/png"
        alt="Placeholder banner"
      />
    </div>
    <section
      class="@container h-full md:min-w-15 md:border-r md:border-gray-300 md:pt-2.5"
      aria-label="Categories"
    >
      <ul class="grid w-full gap-1 @sm:grid @sm:grid-cols-2">
        <li
          v-for="category in categories"
          :key="category.slug"
        >
          <BaseLink
            :href="home()"
            class="hover:text-gray-500"
            >{{ category.name }}</BaseLink
          >
        </li>
      </ul>
    </section>
  </section>
</template>

<script setup lang="ts">
import BaseLink from '@/components/BaseLink.vue';
import { home } from '@/routes';
import { Category } from '@/types';

defineProps<{
  categories: Category[];
}>();
</script>
