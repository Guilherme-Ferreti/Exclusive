<template>
  <div
    v-on-click-outside="
      () => {
        isOpen = false;
      }
    "
  >
    <button
      type="button"
      class="cursor-pointer"
      :aria-label="label"
      :title="label"
      :aria-expanded="isOpen"
      aria-haspopup="true"
      :class="[
        anchorClasses,
        {
          [String(openAnchorClasses)]: isOpen,
        },
      ]"
      :style="`anchor-name:--context-menu-${id}`"
      @click="isOpen = !isOpen"
    >
      <AppIcon :icon="icon" />
    </button>
    <ul
      v-if="isOpen"
      class="absolute top-0.5 z-10 min-w-12 space-y-1 rounded-sm bg-white pt-1 pr-0.5 pb-0.5 pl-1 shadow-sm [position-area:bottom_span-left]"
      :style="`position-anchor:--context-menu-${id}`"
    >
      <slot />
    </ul>
  </div>
</template>

<script setup lang="ts">
import { type Icon } from '@tabler/icons-vue';
import { vOnClickOutside } from '@vueuse/components';
import { ref, useId } from 'vue';
import AppIcon from './AppIcon.vue';

defineProps<{
  icon: Icon;
  label: string;
  anchorClasses?: string;
  openAnchorClasses?: string;
}>();

const id = useId();
const isOpen = ref(false);
</script>
