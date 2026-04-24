<template>
  <Head :title="searchQuery" />
  <AppSection aria-label="Product search">
    <Form
      :action="route('products.search')"
      method="get"
      class="flex flex-wrap gap-2"
      :options="{ only: ['products'], reset: ['products'] }"
    >
      <AppInput
        v-model="searchQuery"
        type="search"
        name="q"
        placeholder="Search products..."
        autocomplete="search"
        class="w-full md:flex-1"
      />
      <select
        v-model="selectedCategory"
        name="category"
        class="rounded-sm border border-gray-500 bg-gray-300"
      >
        <option
          value=""
          class="bg-white"
        >
          All Categories
        </option>
        <option
          v-for="category in categories"
          :key="category.id"
          :value="category.id"
          class="bg-white"
        >
          {{ category.name }}
        </option>
      </select>
      <AppButton
        type="submit"
        label="Search"
      />
    </Form>
  </AppSection>
  <hr class="app-divider" />
  <AppSection aria-label="Search results">
    <AppSectionBadge :text="`${products.total} ${products.total === 1 ? 'result' : 'results'}`" />
    <InfiniteScroll
      v-if="products.total > 0"
      data="products"
    >
      <ProductPreviewGrid :products="products.data" />
      <template #loading>
        <AppLoadingIndicator message="Loading more products..." />
      </template>
    </InfiniteScroll>
    <AppEmptyState
      v-else
      title="No products found"
      description="Try adjusting your search or filter criteria"
      :icon="IconMoodSad"
    />
  </AppSection>
</template>

<script setup lang="ts">
import AppButton from '@/components/AppButton.vue';
import AppEmptyState from '@/components/AppEmptyState.vue';
import AppInput from '@/components/AppInput.vue';
import AppLoadingIndicator from '@/components/AppLoadingIndicator.vue';
import AppSection from '@/components/AppSection.vue';
import AppSectionBadge from '@/components/AppSectionBadge.vue';
import ProductPreviewGrid from '@/components/ProductPreviewGrid.vue';
import { PaginatedResults } from '@/types';
import { route } from '@/types/helpers/route';
import { Form, Head, InfiniteScroll } from '@inertiajs/vue3';
import { IconMoodSad } from '@tabler/icons-vue';
import { useUrlSearchParams } from '@vueuse/core';
import { computed } from 'vue';

const props = defineProps<{
  products: PaginatedResults<App.Data.Inertia.ProductPreview>;
  categories: App.Data.Inertia.Category[];
}>();

const params = useUrlSearchParams();

const searchQuery = computed(() => (typeof params.q === 'string' ? params.q : ''));
const selectedCategory = computed(() => props.categories.find((category) => category.id === params.category)?.id ?? '');
</script>
