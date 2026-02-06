<template>
  <div class="md:-mt-3.75">
    <TheHero :categories="categories" />
  </div>
  <section
    class="flex w-full flex-col gap-1.5"
    aria-label="Today's featured products"
  >
    <AppSectionBadge text="Today's featured" />
    <div class="flex flex-wrap justify-between gap-1.25">
      <div class="flex items-end gap-1.25">
        <h2 class="text-4xl font-semibold">Featured</h2>
        <AppCountdown
          :targetTime="new Date(new Date().setHours(23, 59, 59, 999))"
          aria-hidden="true"
        />
      </div>
    </div>
    <swiper-container
      :slides-per-view="4"
      :space-between="30"
      :loop="true"
      :autoplay-delay="5000"
      :autoplay-pause-on-mouse-enter="true"
      :navigation="true"
    >
      <swiper-slide
        v-for="product in todayFeaturedProducts"
        :key="product.id"
      >
        <ProductPreviewCard :product="product" />
      </swiper-slide>
    </swiper-container>
    <div class="grid gap-2.5">
      <AppButton
        label="View All Products"
        :href="auth.login.create()"
        class="m-auto"
      />
      <hr class="w-full border-b border-gray-300" />
    </div>
  </section>
</template>

<script setup lang="ts">
import AppButton from '@/components/AppButton.vue';
import AppCountdown from '@/components/AppCountdown.vue';
import AppSectionBadge from '@/components/AppSectionBadge.vue';
import ProductPreviewCard from '@/components/ProductPreviewCard.vue';
import TheHero from '@/components/TheHero.vue';
import auth from '@/routes/auth';
import { Category, ProductPreview } from '@/types';

defineProps<{
  categories: Category[];
  todayFeaturedProducts: ProductPreview[];
}>();
</script>
