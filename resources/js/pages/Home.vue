<template>
  <div class="md:-mt-3.75">
    <TheHero :categories="featuredCategories" />
  </div>
  <AppSection aria-label="Today's featured products">
    <AppSectionBadge text="Today's Featured" />
    <ProductPreviewCarrosel :products="featuredProducts">
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
    <template #footer>
      <AppButton
        label="View All Products"
        :href="auth.login.create()"
        class="m-auto"
      />
    </template>
  </AppSection>
  <AppSection aria-label="Best selling products this month">
    <AppSectionBadge text="This Month" />
    <h2 class="app-heading">Best Selling Products</h2>
    <ProductPreviewGrid :products="bestSellingProducts" />
  </AppSection>
</template>

<script setup lang="ts">
import AppButton from '@/components/AppButton.vue';
import AppCountdown from '@/components/AppCountdown.vue';
import AppSection from '@/components/AppSection.vue';
import AppSectionBadge from '@/components/AppSectionBadge.vue';
import ProductPreviewCarrosel from '@/components/ProductPreviewCarrosel.vue';
import ProductPreviewGrid from '@/components/ProductPreviewGrid.vue';
import TheHero from '@/components/TheHero.vue';
import auth from '@/routes/auth';

defineProps<{
  featuredCategories: App.Data.Inertia.Category[];
  featuredProducts: App.Data.Inertia.ProductPreview[];
  bestSellingProducts: App.Data.Inertia.ProductPreview[];
}>();
</script>
