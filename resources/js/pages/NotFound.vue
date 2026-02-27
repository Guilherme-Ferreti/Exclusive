<template>
  <AppBreadcrumbs
    :breadcrumbs="[
      { name: 'Home', href: home() },
      { name: '404 Error', isActive: true },
    ]"
  />
  <div class="text-center">
    <h1 class="text-7xl font-medium">404 Not Found</h1>
    <p class="mt-2">Sorry, the page you are looking for could not be found.</p>
    <AppButton
      class="mt-4"
      :href="home()"
      label="Back to home page"
    />
  </div>
</template>

<script setup lang="ts">
import AppBreadcrumbs from '@/components/AppBreadcrumbs.vue';
import AppButton from '@/components/AppButton.vue';
import { home } from '@/routes';
</script>
