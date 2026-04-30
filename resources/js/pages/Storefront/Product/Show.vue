<template>
  <Head :title="`${product.name} (${product.category.name})`" />
  <AppBreadcrumbs
    :breadcrumbs="[
      { name: 'Home', href: route('storefront.home') },
      { name: product.category.name, href: route('storefront.home') },
      { name: product.name, href: route('storefront.products.show', { product: product.id }), isActive: true },
    ]"
  />
  <div class="flex flex-col justify-evenly gap-2 md:flex-row md:gap-4">
    <div class="max-w-20 self-center rounded-md bg-gray-300 p-(--padding-inline)">
      <AppZoomableImage
        :src="product.detailImage"
        :detail-url="product.detailImage"
        :alt="product.name"
      />
    </div>
    <div class="flex w-full flex-col gap-1.5 md:max-w-30">
      <div class="space-y-1">
        <h1 class="font-inter text-2xl font-semibold">{{ product.name }}</h1>
        <p class="font-inter text-2xl">{{ formatPrice(product.currentPrice) }}</p>
      </div>
      <p>{{ product.description }}</p>
      <hr class="app-divider | mt-auto" />
      <div class="flex flex-wrap gap-1">
        <AddItemToCartForm :product-id="product.id" />
        <WishlistButton
          class="border border-gray-500"
          :product-id="product.id"
          shape="square"
        />
      </div>
    </div>
  </div>
  <AppSection aria-label="Related items">
    <AppSectionBadge text="Related items" />
    <ProductPreviewGrid :products="relatedProducts" />
  </AppSection>
</template>

<script setup lang="ts">
import AddItemToCartForm from '@/components/AddItemToCartForm.vue';
import AppBreadcrumbs from '@/components/AppBreadcrumbs.vue';
import AppSection from '@/components/AppSection.vue';
import AppSectionBadge from '@/components/AppSectionBadge.vue';
import AppZoomableImage from '@/components/AppZoomableImage.vue';
import ProductPreviewGrid from '@/components/ProductPreviewGrid.vue';
import WishlistButton from '@/components/WishlistButton.vue';
import { formatPrice } from '@/lib/utils';
import { route } from '@/types/helpers/route';
import { Head } from '@inertiajs/vue3';

defineProps<{
  product: {
    id: string;
    name: string;
    description: string;
    detailImage: string;
    currentPrice: number;
    category: {
      id: string;
      name: string;
    };
  };
  relatedProducts: {
    id: string;
    name: string;
    previewImage: string;
    detailImage: string;
    currentPrice: number;
  }[];
}>();
</script>
