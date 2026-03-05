<template>
  <AppBreadcrumbs
    :breadcrumbs="[
      { name: 'Home', href: home() },
      { name: product.category.name, href: home() },
      { name: product.name, href: products.show(product.id), isActive: true },
    ]"
  />
  <div class="flex flex-col gap-2 md:flex-row">
    <img
      :src="product.detailImage"
      :alt="product.name"
      class="mx-auto max-w-15"
    />
    <div class="flex w-full flex-col gap-1.5">
      <h1 class="text-2xl font-semibold">{{ product.name }}</h1>
      <span class="text-2xl">{{ formatPrice(product.currentPrice) }}</span>
      <p>{{ product.description }}</p>
      <hr class="mt-auto border-b border-b-black-50 opacity-50" />
      <div class="flex flex-wrap items-end gap-1">
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
