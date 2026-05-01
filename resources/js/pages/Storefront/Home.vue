<template>
  <div class="md:-mt-3">
    <TheHero :categories="featuredCategories" />
  </div>
  <AppSection aria-label="Today's featured products">
    <AppSectionBadge text="Today's Featured" />
    <ProductPreviewCarrosel :products="featuredProducts">
      <template #header>
        <div class="flex flex-wrap items-end justify-center gap-x-1.5 gap-y-0.5 md:justify-start">
          <h2 class="app-heading">Featured</h2>
          <AppCountdown
            :target-time="new Date(new Date().setHours(23, 59, 59, 999))"
            aria-hidden="true"
          />
        </div>
      </template>
    </ProductPreviewCarrosel>
    <template #footer>
      <AppButton
        label="View All Products"
        :href="route('storefront.products.index')"
        class="m-auto"
      />
    </template>
  </AppSection>
  <hr class="app-divider" />
  <AppSection aria-label="Best selling products this month">
    <AppSectionBadge text="This Month" />
    <h2 class="app-heading">Best Selling Products</h2>
    <BestSellingProductsGrid :products="bestSellingProducts" />
  </AppSection>
</template>

<script setup lang="ts">
import AppButton from '@/components/AppButton.vue';
import AppCountdown from '@/components/AppCountdown.vue';
import AppSection from '@/components/AppSection.vue';
import AppSectionBadge from '@/components/AppSectionBadge.vue';
import BestSellingProductsGrid from '@/components/BestSellingProductsGrid.vue';
import ProductPreviewCarrosel from '@/components/ProductPreviewCarrosel.vue';
import TheHero from '@/components/TheHero.vue';
import { route } from '@/types/helpers/route';

defineProps<{
  featuredCategories: {
    id: string;
    name: string;
  }[];
  featuredProducts: {
    id: string;
    name: string;
    previewImage: string;
    detailImage: string;
    currentPrice: number;
  }[];
  bestSellingProducts: {
    id: string;
    name: string;
    previewImage: string;
    detailImage: string;
    currentPrice: number;
    timesSold: number;
  }[];
}>();
</script>
