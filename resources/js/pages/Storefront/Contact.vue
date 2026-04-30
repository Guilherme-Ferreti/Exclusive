<template>
  <Head title="Contact" />
  <AppBreadcrumbs
    :breadcrumbs="[
      {
        name: 'Home',
        href: route('storefront.home'),
        isActive: false,
      },
      {
        name: 'Contact',
        href: route('storefront.contact'),
        isActive: true,
      },
    ]"
  />
  <section
    aria-label="Contact"
    class="flex w-full flex-wrap justify-center gap-3"
  >
    <div class="space-y-1">
      <div class="contact__title-wrapper">
        <div class="contact__icon-wrapper">
          <AppIcon :icon="IconPhone" />
        </div>
        <h2 class="contact__title">Call To Us</h2>
      </div>
      <p>We are available 24/7, 7 days a week.</p>
      <p>Phone: +8801611112222</p>
    </div>
    <div class="h-full w-[0.5px] bg-black opacity-30"></div>
    <div class="space-y-1">
      <div class="contact__title-wrapper">
        <div class="contact__icon-wrapper">
          <AppIcon :icon="IconMail" />
        </div>
        <h2 class="contact__title">Write To Us</h2>
      </div>
      <p>We will contact you within 24 hours.</p>
      <p>E-mail: support@exclusive.com</p>
    </div>
  </section>
</template>

<script setup lang="ts">
import AppBreadcrumbs from '@/components/AppBreadcrumbs.vue';
import AppIcon from '@/components/AppIcon.vue';
import { route } from '@/types/helpers/route';
import { Head } from '@inertiajs/vue3';
import { IconMail, IconPhone } from '@tabler/icons-vue';
</script>

<style scoped>
@reference 'tailwindcss';

.contact__title-wrapper {
  @apply flex items-center gap-1;
}

.contact__title {
  @apply text-lg font-semibold text-black;
}

.contact__icon-wrapper {
  @apply grid size-2.5 place-items-center rounded-full bg-red-500 text-white;
}
</style>
