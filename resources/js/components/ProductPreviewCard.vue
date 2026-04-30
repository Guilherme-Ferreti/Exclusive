<template>
  <div class="w-17">
    <div class="rounded-sm bg-gray-300 p-0.75">
      <div class="relative flex justify-center">
        <AppZoomableImage
          :src="product.previewImage"
          :alt="`${product.name} preview`"
          :detail-url="product.detailImage"
          class="w-10"
        />
        <div class="absolute top-0 right-0 space-y-0.5">
          <AppIconButton
            :icon="IconEye"
            variant="white"
            size="sm"
            shape="circle"
            title="View"
            :href="route('storefront.products.show', { product: product.id })"
          />
          <WishlistButton
            :product-id="product.id"
            size="sm"
          />
        </div>
      </div>
    </div>
    <div class="mt-1 space-y-0.5 text-center">
      <p class="font-medium">{{ product.name }}</p>
      <p class="font-bold">{{ formatPrice(product.currentPrice) }}</p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { formatPrice } from '@/lib/utils';
import { route } from '@/types/helpers/route';
import { IconEye } from '@tabler/icons-vue';
import AppIconButton from './AppIconButton.vue';
import AppZoomableImage from './AppZoomableImage.vue';
import WishlistButton from './WishlistButton.vue';

defineProps<{
  product: {
    id: string;
    name: string;
    previewImage: string;
    detailImage: string;
    currentPrice: number;
  };
}>();
</script>
