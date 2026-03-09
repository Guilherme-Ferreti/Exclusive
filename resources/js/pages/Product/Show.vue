<template>
  <AppBreadcrumbs
    :breadcrumbs="[
      { name: 'Home', href: home() },
      { name: product.category.name, href: home() },
      { name: product.name, href: products.show(product.id), isActive: true },
    ]"
  />
  <div class="flex flex-col justify-evenly gap-2 md:flex-row md:gap-4">
    <div
      v-viewer.static="{ navbar: false, toolbar: { zoomIn: true, zoomOut: true } }"
      class="max-w-20 self-center rounded-md bg-gray-300 p-(--padding-inline)"
    >
      <img
        :src="product.detailImage"
        :alt="product.name"
        class="cursor-zoom-in object-contain transition-transform duration-300 hover:scale-105"
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
        <AppButton
          label="Add to Cart"
          type="submit"
          @click="addToCart"
        />
        <WishlistButton
          class="border border-black-50"
          :productId="product.id"
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
import AppBreadcrumbs from '@/components/AppBreadcrumbs.vue';
import AppButton from '@/components/AppButton.vue';
import AppSection from '@/components/AppSection.vue';
import AppSectionBadge from '@/components/AppSectionBadge.vue';
import ProductPreviewGrid from '@/components/ProductPreviewGrid.vue';
import WishlistButton from '@/components/WishlistButton.vue';
import { formatPrice } from '@/lib/utils';
import { home } from '@/routes';
import cart from '@/routes/cart';
import products from '@/routes/products';
import { router } from '@inertiajs/vue3';

const props = defineProps<{
  product: App.Data.Inertia.ProductShow;
  relatedProducts: App.Data.Inertia.ProductPreview[];
}>();

function addToCart() {
  router.post(cart.items.store(), { productId: props.product.id, quantity: 1 }, { preserveScroll: true });
}
</script>
