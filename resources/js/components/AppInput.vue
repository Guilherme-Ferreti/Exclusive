<template>
  <div class="relative inline-block w-full">
    <component
      v-if="icon"
      :is="icon"
      class="absolute top-1/2 right-0.75 -translate-y-1/2"
    />
    <input
      type="text"
      class="w-full py-0.5"
      :class="{
        'bg-gray-300 pr-3 pl-0.75': !variant,
        'border-b border-gray-500 outline-offset-1': variant === InputVariant.UNDERLINE,
      }"
      :name="name"
      :placeholder="placeholder"
      :autocomplete="autocomplete"
    />
  </div>
</template>

<script lang="ts">
enum InputVariant {
  UNDERLINE = 'underline',
}
</script>

<script setup lang="ts">
import { type Icon } from '@tabler/icons-vue';

defineProps<{
  type: HTMLInputElement['type'];
  name?: string;
  placeholder?: string;
  icon?: Icon;
  autocomplete?: string;
  variant?: `${InputVariant}`;
}>();
</script>
