<template>
  <div class="md:-mt-3.75">
    <TheHero :categories="categories" />
  </div>
  <section
    class="flex w-full flex-col gap-1.5"
    aria-label="Today's featured products"
  >
    <AppSectionBadge text="Today's featured" />
    <ProductPreviewCarrosel :products="todayFeaturedProducts">
      <template #header>
        <div class="flex flex-wrap items-end gap-x-1.5 gap-y-0.5">
          <h2 class="app-heading">Featured</h2>
          <AppCountdown
            :targetTime="new Date(new Date().setHours(23, 59, 59, 999))"
            aria-hidden="true"
          />
        </div>
      </template>
    </ProductPreviewCarrosel>
    <div class="grid gap-2.5">
      <AppButton
        label="View All Products"
        :href="auth.login.create()"
        class="m-auto"
      />
      <hr class="w-full border-b border-gray-300" />
    </div>
  </section>
</template>

<script setup lang="ts">
import AppButton from '@/components/AppButton.vue';
import AppCountdown from '@/components/AppCountdown.vue';
import AppSectionBadge from '@/components/AppSectionBadge.vue';
import ProductPreviewCarrosel from '@/components/ProductPreviewCarrosel.vue';
import TheHero from '@/components/TheHero.vue';
import auth from '@/routes/auth';
import { Category, ProductPreview } from '@/types';

defineProps<{
  categories: Category[];
  todayFeaturedProducts: ProductPreview[];
}>();
</script>
