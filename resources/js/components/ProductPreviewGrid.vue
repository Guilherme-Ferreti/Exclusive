<template>
  <div class="grid grid-cols-[repeat(auto-fit,minmax(17rem,1fr))] place-items-center gap-1.5">
    <ProductPreviewCard
      v-for="product in products"
      :key="product.id"
      :product="product"
    />
  </div>
</template>

<script lang="ts" setup>
import { ProductPreview } from '@/types';
import ProductPreviewCard from './ProductPreviewCard.vue';

defineProps<{
  products: ProductPreview[];
}>();
</script>
