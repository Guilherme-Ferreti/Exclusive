<template>
  <div class="relative inline-block">
    <component
      v-if="icon"
      :is="icon"
      class="absolute top-1/2 right-0.75 -translate-y-1/2"
    />
    <input
      class="w-full bg-gray-300 py-0.5 pr-3 pl-0.75 text-sm"
      type="text"
      :name="name"
      :placeholder="placeholder"
    />
  </div>
</template>

<script setup lang="ts">
import { Icon } from '@tabler/icons-vue';

defineProps<{
  type: HTMLInputElement['type'];
  name?: string;
  placeholder?: string;
  icon?: Icon;
}>();
</script>
