<template>
  <ProductGridContainer>
    <div
      v-for="product in products"
      :key="product.id"
      class="grid place-items-center gap-1"
    >
      <ProductPreviewCard :product="product" />
      <AppBadge
        :label="`Sold ${product.timesSold} times`"
        :color="BadgeColor.BLUE"
      />
    </div>
  </ProductGridContainer>
</template>

<script setup lang="ts">
import AppBadge, { BadgeColor } from './AppBadge.vue';
import ProductGridContainer from './ProductGridContainer.vue';
import ProductPreviewCard from './ProductPreviewCard.vue';

defineProps<{
  products: {
    id: string;
    name: string;
    previewImage: string;
    detailImage: string;
    currentPrice: number;
    timesSold: number;
  }[];
}>();
</script>
