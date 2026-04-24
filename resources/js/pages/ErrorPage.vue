<template>
  <Head :title="title" />
  <AppBreadcrumbs
    :breadcrumbs="[
      { name: 'Home', href: route('home') },
      { name: title, isActive: true },
    ]"
  />
  <div class="text-center">
    <h1 class="text-7xl font-medium">{{ title }}</h1>
    <p class="mt-2">{{ description }}</p>
    <AppButton
      class="mt-4"
      :href="route('home')"
      label="Back to home page"
    />
  </div>
</template>

<script setup lang="ts">
import AppBreadcrumbs from '@/components/AppBreadcrumbs.vue';
import AppButton from '@/components/AppButton.vue';
import { route } from '@/types/helpers/route';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
  status: 403 | 404 | 500 | 503;
}>();

const title = computed(() => {
  return {
    403: '403 Forbidden',
    404: '404 Not Found',
    500: '500 Internal Server Error',
    503: '503 Service Unavailable',
  }[props.status];
});

const description = computed(() => {
  return {
    403: 'You are not authorized to access this page.',
    404: 'Sorry, the page you are looking for could not be found.',
    500: 'An error occurred on the server.',
    503: 'The server is currently unavailable.',
  }[props.status];
});
</script>
