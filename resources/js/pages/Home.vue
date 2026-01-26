<template>
  <div class="md:-mt-3.75">
    <TheHero :categories="categories" />
  </div>
</template>

<script setup lang="ts">
import TheHero from '@/components/TheHero.vue';
import { Category } from '@/types';

defineProps<{
  categories: Category[];
}>();
</script>
