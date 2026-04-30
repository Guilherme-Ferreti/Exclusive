<template>
  <AppLayout>
    <div class="flex flex-wrap justify-between gap-1.5">
      <AppBreadcrumbs
        :breadcrumbs="[
          {
            name: 'Home',
            href: route('storefront.home'),
            isActive: false,
          },
          {
            name: 'My Account',
            href: route('account.profile.edit'),
            isActive: true,
          },
        ]"
      />
      <p class="text-sm">
        Welcome! <span class="text-red-500">{{ $page.props.auth.user.name }}</span>
      </p>
    </div>
    <div class="grid gap-2.5 md:grid-cols-[auto_1fr] md:gap-3">
      <TheAccountNavbar />
      <slot />
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import AppBreadcrumbs from '@/components/AppBreadcrumbs.vue';
import TheAccountNavbar from '@/components/TheAccountNavbar.vue';
import { route } from '@/types/helpers/route';
import AppLayout from './AppLayout.vue';
</script>
