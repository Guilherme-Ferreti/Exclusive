<template>
  <div class="w-17">
    <div class="rounded-sm bg-gray-300 p-0.75">
      <div class="relative flex justify-center">
        <div v-viewer.static="{ navbar: false, toolbar: { zoomIn: true, zoomOut: true }, url: 'data-detail' }">
          <img
            :src="product.previewImage"
            :alt="`${product.name} preview`"
            class="w-10 cursor-zoom-in object-contain transition-transform duration-300 hover:scale-105"
            loading="lazy"
            :data-detail="product.detailImage"
          />
        </div>
        <div class="absolute top-0 right-0 flex flex-col gap-0.5">
          <AppIconButton
            :icon="IconEye"
            variant="white"
            size="sm"
            shape="circle"
            title="View"
            :href="products.show(product.id)"
          />
          <WishlistButton :productId="product.id" />
        </div>
      </div>
    </div>
    <div class="mt-1 grid gap-0.5 text-center">
      <p class="font-medium">{{ product.name }}</p>
      <p class="font-bold">{{ formatPrice(product.currentPrice) }}</p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { formatPrice } from '@/lib/utils';
import products from '@/routes/products';
import { IconEye } from '@tabler/icons-vue';
import AppIconButton from './AppIconButton.vue';
import WishlistButton from './WishlistButton.vue';

defineProps<{
  product: App.Data.Inertia.ProductPreview;
}>();
</script>
