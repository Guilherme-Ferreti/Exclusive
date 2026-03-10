<template>
  <div class="flex h-2.5">
    <button
      class="quantity-button rounded-l-md border border-black-50"
      type="button"
      @click="decrement"
    >
      <IconMinus />
    </button>
    <input
      v-model="model"
      type="number"
      :min="min"
      :max="max"
      :step="step"
      :name="name"
      :required="required"
      class="no-spinner w-5 border-y border-black-50 text-center text-lg font-medium"
    />
    <button
      class="quantity-button rounded-r-md border border-black-50"
      type="button"
      @click="increment"
    >
      <IconPlus />
    </button>
  </div>
</template>

<script setup lang="ts">
import { IconMinus, IconPlus } from '@tabler/icons-vue';

const model = defineModel<number>({
  default: 1,
});

const props = withDefaults(
  defineProps<{
    min: number;
    max: number;
    step: number;
    name: string;
    required?: boolean;
  }>(),
  {
    required: false,
  },
);

function increment() {
  if (model.value === props.max) {
    return;
  }

  model.value += props.step;
}

function decrement() {
  if (model.value === props.min) {
    return;
  }

  model.value -= props.step;
}
</script>

<style scoped>
@reference 'tailwindcss';

.quantity-button {
  @apply flex items-center justify-center p-0.5 not-disabled:cursor-pointer disabled:cursor-auto;

  svg {
    @apply size-1.25;
  }
}
</style>
