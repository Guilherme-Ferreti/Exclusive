<template>
  <div class="flex flex-wrap gap-1.5">
    <ProductPreviewCard
      v-for="product in products"
      :key="product.id"
      :product="product"
    />
  </div>
</template>

<script lang="ts" setup>
import ProductPreviewCard from './ProductPreviewCard.vue';

defineProps<{
  products: App.Data.Inertia.ProductPreview[];
}>();
</script>
