<template>
  <div class="w-17">
    <div class="rounded-sm bg-gray-300 p-0.75">
      <div class="relative flex justify-center">
        <img
          :src="previewImage"
          :alt="`${product.name} preview`"
          class="w-10 object-contain"
          loading="lazy"
        />
        <div class="absolute top-0 right-0 flex flex-col gap-0.5">
          <AppIconButton
            :icon="IconEye"
            variant="white"
            size="sm"
            shape="circle"
            title="View"
            :href="home()"
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
import { home } from '@/routes';
import { IconEye } from '@tabler/icons-vue';
import AppIconButton from './AppIconButton.vue';
import WishlistButton from './WishlistButton.vue';

const props = defineProps<{
  product: App.Data.Inertia.ProductPreview;
}>();

const previewImage = props.product.previewImage
  ? props.product.previewImage
  : `https://placehold.co/160x220?text=${props.product.name.split(' ')[0]}`;
</script>
