<template>
  <AppBreadcrumbs
    :breadcrumbs="[
      { name: 'Home', href: home() },
      { name: product.category.name, href: home() },
      { name: product.name, href: products.show(product.id), isActive: true },
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
          class="border border-black/50"
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
import { home } from '@/routes';
import products from '@/routes/products';

defineProps<{
  product: App.Data.Inertia.ProductShow;
  relatedProducts: App.Data.Inertia.ProductPreview[];
}>();
</script>
