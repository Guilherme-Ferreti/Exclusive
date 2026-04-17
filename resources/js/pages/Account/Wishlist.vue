<template>
  <Head title="Wishlist" />
  <div
    v-if="products.length === 0"
    class="flex items-center justify-center text-center text-gray-500"
  >
    <p>Your wishlist is empty</p>
  </div>
  <ProductPreviewGrid
    v-else
    :products="products"
  />
</template>

<script setup lang="ts">
import ProductPreviewGrid from '@/components/ProductPreviewGrid.vue';
import AccountLayout from '@/layouts/AccountLayout.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({
  layout: AccountLayout,
});

defineProps<{
  products: App.Data.Inertia.ProductPreview[];
}>();
</script>
