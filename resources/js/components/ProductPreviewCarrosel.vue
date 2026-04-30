<template>
  <div>
    <div class="mb-1.5 flex flex-wrap items-center gap-0.75">
      <slot name="header" />
      <div class="flex gap-0.75 sm:ml-auto">
        <AppIconButton
          :id="prevButtonElId"
          :icon="IconArrowLeft"
          variant="secondary"
          shape="circle"
        />
        <AppIconButton
          :id="nextButtonElId"
          :icon="IconArrowRight"
          variant="secondary"
          shape="circle"
        />
      </div>
    </div>
    <swiper-container
      :slides-per-view="'auto'"
      :space-between="24"
      :centered-slides="true"
      :navigation="{
        enabled: true,
        nextEl: `#${nextButtonElId}`,
        prevEl: `#${prevButtonElId}`,
      }"
      :autoplay="{
        delay: 5000,
        pauseOnMouseEnter: true,
      }"
      :breakpoints="{
        '580': {
          centeredSlides: false,
        },
        '1200': {
          slidesPerView: 4,
          centeredSlides: false,
        },
      }"
    >
      <swiper-slide
        v-for="product in products"
        :key="product.id"
        class="w-fit"
      >
        <ProductPreviewCard :product="product" />
      </swiper-slide>
    </swiper-container>
  </div>
</template>

<script setup lang="ts">
import { IconArrowLeft, IconArrowRight } from '@tabler/icons-vue';
import { useId } from 'vue';
import AppIconButton from './AppIconButton.vue';
import ProductPreviewCard from './ProductPreviewCard.vue';

defineProps<{
  products: {
    id: string;
    name: string;
    previewImage: string;
    detailImage: string;
    currentPrice: number;
  }[];
}>();

const nextButtonElId = useId();
const prevButtonElId = useId();
</script>
