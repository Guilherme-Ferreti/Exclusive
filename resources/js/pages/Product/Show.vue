<template>
  <AppBreadcrumbs
    :breadcrumbs="[
      { name: 'Home', href: home() },
      { name: product.category.name, href: home() },
      { name: product.name, href: products.show(product.id), isActive: true },
    ]"
  />
  <div class="grid grid-cols-[auto_1fr] gap-3">
    <div v-viewer.static="{ navbar: false, toolbar: { zoomIn: true, zoomOut: true } }">
      <img
        :src="product.detailImage"
        :alt="product.name"
        class="mx-auto max-w-15 cursor-zoom-in"
      />
    </div>
    <div class="flex flex-col gap-1.25 rounded-md p-1.5 shadow-md">
      <h1 class="text-2xl font-semibold">{{ product.name }}</h1>
      <p>{{ product.description }}</p>
      <p class="mt-auto text-2xl font-semibold">{{ formatPrice(product.currentPrice) }}</p>
      <div class="mt-auto flex flex-wrap gap-1">
        <AppButton
          label="Add to Cart"
          :href="home()"
        />
        <WishlistButton
          class="border border-black-50"
          :productId="product.id"
          size="lg"
          shape="square"
        />
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import AppBreadcrumbs from '@/components/AppBreadcrumbs.vue';
import AppButton from '@/components/AppButton.vue';
import WishlistButton from '@/components/WishlistButton.vue';
import { formatPrice } from '@/lib/utils';
import { home } from '@/routes';
import products from '@/routes/products';

defineProps<{
  product: App.Data.Inertia.ProductShow;
}>();
</script>
