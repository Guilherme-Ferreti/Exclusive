<template>
  <section class="md:grid md:grid-cols-[minmax(0,1fr)_minmax(0,4fr)]">
    <div class="mb-3 md:order-last md:pt-2.5 md:pl-2.5">
      <swiper-container
        slides-per-view="1"
        space-between="0"
        speed="2000"
        loop="true"
        autoplay-delay="5000"
        pagination-clickable="true"
      >
        <swiper-slide
          v-for="banner in banners"
          :key="banner"
        >
          <img
            class="size-full object-cover"
            :src="banner"
            alt="Placeholder banner"
          />
        </swiper-slide>
      </swiper-container>
    </div>
    <section
      class="@container h-full md:border-r md:border-gray-300 md:pt-2.5"
      aria-label="Categories"
    >
      <ul class="grid w-full gap-1 @sm:grid @sm:grid-cols-2">
        <li
          v-for="category in categories"
          :key="category.slug"
        >
          <BaseLink
            :href="home()"
            class="hover:text-gray-500"
            >{{ category.name }}</BaseLink
          >
        </li>
      </ul>
    </section>
  </section>
</template>

<script setup lang="ts">
import BaseLink from '@/components/BaseLink.vue';
import { home } from '@/routes';
import { Category } from '@/types';

defineProps<{
  categories: Category[];
}>();

const banners = [
  'https://placehold.co/892x344/D3D3D3/555555/webp?text=Exclusive',
  'https://placehold.co/892x344/F6F6F6/000000/webp?text=Exclusive',
  'https://placehold.co/892x344/ecf0f1/7f8c8d/webp?text=Exclusive',
];
</script>
