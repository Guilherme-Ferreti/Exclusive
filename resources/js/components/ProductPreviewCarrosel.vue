<template>
  <div>
    <div class="mb-1.5 flex flex-wrap items-center gap-0.75">
      <slot name="header" />
      <div class="flex gap-0.75 sm:ml-auto">
        <AppIconButton
          :icon="IconArrowLeft"
          variant="secondary"
          size="lg"
          shape="circle"
          :id="prevButtonElId"
        />
        <AppIconButton
          :icon="IconArrowRight"
          variant="secondary"
          size="lg"
          shape="circle"
          :id="nextButtonElId"
        />
      </div>
    </div>
    <swiper-container
      :slides-per-view="'auto'"
      :space-between="30"
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
        '1200': {
          slidesPerView: 4,
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
import { ProductPreview } from '@/types';
import { IconArrowLeft, IconArrowRight } from '@tabler/icons-vue';
import { useId } from 'vue';
import AppIconButton from './AppIconButton.vue';
import ProductPreviewCard from './ProductPreviewCard.vue';

defineProps<{
  products: ProductPreview[];
}>();

const nextButtonElId = useId();
const prevButtonElId = useId();
</script>
