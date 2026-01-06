<template>
  <AppLayout>
    <div class="flex flex-wrap justify-between gap-1.5">
      <AppBreadcrumbs
        :breadcrumbs="[
          {
            name: 'Home',
            href: home(),
            isActive: false,
          },
          {
            name: 'My Account',
            href: account.profile.edit(),
            isActive: true,
          },
        ]"
      />
      <p class="text-sm">
        Welcome! <span class="text-red-500">{{ $page.props.auth.user.name }}</span>
      </p>
    </div>
    <div class="mt-3 grid gap-3 md:grid-cols-[auto_1fr]">
      <TheAccountNavbar />
      <slot />
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import AppBreadcrumbs from '@/components/AppBreadcrumbs.vue';
import TheAccountNavbar from '@/components/TheAccountNavbar.vue';
import { home } from '@/routes';
import account from '@/routes/account';
import AppLayout from './AppLayout.vue';
</script>
