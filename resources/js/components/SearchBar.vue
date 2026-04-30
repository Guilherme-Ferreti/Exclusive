<template>
  <Form
    :action="route('storefront.products.index')"
    method="get"
  >
    <AppInput
      type="search"
      class="text-sm"
      name="search"
      aria-label="Search products"
      placeholder="What are you looking for?"
      :icon-right="IconSearch"
      icon-right-type="submit"
      icon-right-title="Search"
    />
  </Form>
</template>

<script setup lang="ts">
import { route } from '@/types/helpers/route';
import { Form } from '@inertiajs/vue3';
import { IconSearch } from '@tabler/icons-vue';
import AppInput from './AppInput.vue';
</script>
