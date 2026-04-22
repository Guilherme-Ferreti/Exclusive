<template>
  <Form>
    <AppInput
      type="search"
      class="text-sm"
      name="search"
      placeholder="What are you looking for?"
      autocomplete="search"
      :icon-right="IconSearch"
      icon-right-type="submit"
      icon-right-title="Search"
    />
  </Form>
</template>

<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { IconSearch } from '@tabler/icons-vue';
import AppInput from './AppInput.vue';
</script>
