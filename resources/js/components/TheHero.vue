<template>
  <div class="md:grid md:grid-cols-[minmax(0,1fr)_minmax(0,4fr)]">
    <section
      class="mb-3 md:order-last md:pt-2.5 md:pl-2.5"
      aria-label="Featured promotions"
    >
      <swiper-container
        :slides-per-view="1"
        :space-between="0"
        :speed="2000"
        :loop="true"
        :autoplay-delay="5000"
        :pagination-clickable="true"
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
    </section>
    <section
      class="@container h-full md:border-r md:border-gray-300 md:pt-2.5 md:pr-0.5"
      aria-label="Featured categories"
    >
      <h2 class="mb-1 text-lg font-bold">Featured Categories</h2>
      <ul class="grid w-full gap-1 @sm:grid @sm:grid-cols-2">
        <li
          v-for="link in categoryLinks"
          :key="link.id"
        >
          <BaseLink
            :href="link.href"
            class="hover:text-gray-500"
            >{{ link.name }}
          </BaseLink>
        </li>
      </ul>
    </section>
  </div>
</template>

<script setup lang="ts">
import BaseLink from '@/components/BaseLink.vue';
import { home } from '@/routes';
import { Category } from '@/types';
import { computed } from 'vue';

const props = defineProps<{
  categories: Category[];
}>();

const banners = [
  'https://placehold.co/892x344/D3D3D3/555555/webp?text=Exclusive',
  'https://placehold.co/892x344/F6F6F6/000000/webp?text=Exclusive',
  'https://placehold.co/892x344/ecf0f1/7f8c8d/webp?text=Exclusive',
];

const categoryLinks = computed(() => [
  ...props.categories.map((item) => ({
    id: item.id,
    name: item.name,
    href: home(),
  })),
  {
    id: '',
    name: 'See All',
    href: home(),
  },
]);
</script>
