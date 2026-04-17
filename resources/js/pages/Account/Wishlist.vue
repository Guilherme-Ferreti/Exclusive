<template>
  <Head title="Wishlist" />
  <AppEmptyState
    v-if="products.length === 0"
    title="Your wishlist is empty"
    description="You haven't added any products to your wishlist yet."
    :icon="IconHeartPlus"
  />
  <ProductPreviewGrid
    v-else
    :products="products"
  />
</template>

<script setup lang="ts">
import AppEmptyState from '@/components/AppEmptyState.vue';
import ProductPreviewGrid from '@/components/ProductPreviewGrid.vue';
import AccountLayout from '@/layouts/AccountLayout.vue';
import { Head } from '@inertiajs/vue3';
import { IconHeartPlus } from '@tabler/icons-vue';

defineOptions({
  layout: AccountLayout,
});

defineProps<{
  products: App.Data.Inertia.ProductPreview[];
}>();
</script>
