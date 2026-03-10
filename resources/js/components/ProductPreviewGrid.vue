<template>
  <div class="@container/product-preview-grid">
    <div class="product-preview-grid">
      <ProductPreviewCard
        v-for="product in products"
        :key="product.id"
        :product="product"
      />
    </div>
  </div>
</template>

<script lang="ts" setup>
import ProductPreviewCard from './ProductPreviewCard.vue';

defineProps<{
  products: App.Data.Inertia.ProductPreview[];
}>();
</script>

<style scoped>
@reference 'tailwindcss';

.product-preview-grid {
  --card-width: calc(var(--spacing) * 17);
  --gap: calc(var(--spacing) * 1.5);

  --two-cols-max-width: calc((var(--card-width) * 2) + var(--gap));
  --three-cols-max-width: calc((var(--card-width) * 3) + (var(--gap) * 2));
  --four-cols-max-width: calc((var(--card-width) * 4) + (var(--gap) * 3));

  @apply mx-auto grid w-full max-w-(--card-width) place-items-center gap-(--gap);

  @container (width >= 568px) {
    @apply max-w-(--two-cols-max-width) grid-cols-2;
  }

  @container (width >= 864px) {
    @apply max-w-(--three-cols-max-width) grid-cols-3;
  }

  @container (width >= 1160px) {
    @apply max-w-(--four-cols-max-width) grid-cols-4;
  }
}
</style>
