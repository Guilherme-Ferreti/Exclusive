<template>
  <div
    class="app-quantity-input"
    :data-has-error="typeof errorMessage === 'string' ? true : undefined"
  >
    <AppInputLabel
      v-if="label"
      :id="labelId"
      :for="inputId"
      :content="label"
    />
    <div
      class="flex h-2.5"
      role="group"
      :aria-labelledby="labelId"
    >
      <button
        class="minus-button"
        type="button"
        :disabled="!canDecrement"
        aria-label="decrease quantity"
        :aria-controls="inputId"
        @click="decrement"
      >
        <IconMinus role="presentation" />
      </button>
      <input
        :id="inputId"
        v-model="model"
        type="number"
        class="input | no-spinner"
        :min="min"
        :max="max"
        :step="step"
        :name="name"
        :required="required"
        :aria-invalid="!!errorMessage"
        :aria-errormessage="errorMessageId"
        :placeholder="placeholder"
      />
      <button
        class="plus-button"
        type="button"
        :disabled="!canIncrement"
        aria-label="increase quantity"
        :aria-controls="inputId"
        @click="increment"
      >
        <IconPlus role="presentation" />
      </button>
    </div>
    <AppInputErrorMessage
      v-if="errorMessage"
      :id="errorMessageId"
      :content="errorMessage"
    />
    <span
      class="sr-only"
      aria-live="polite"
    >
      {{ model }}
    </span>
  </div>
</template>

<script setup lang="ts">
import { IconMinus, IconPlus } from '@tabler/icons-vue';
import { computed, useId } from 'vue';
import AppInputErrorMessage from './AppInputErrorMessage.vue';
import AppInputLabel from './AppInputLabel.vue';

const model = defineModel<number>({
  default: 1,
});

const props = withDefaults(
  defineProps<{
    min: number;
    max: number;
    step: number;
    name: string;
    label?: string;
    required?: boolean;
    placeholder?: string;
    errorMessage?: string;
  }>(),
  {
    required: false,
  },
);

const inputId = `input-${useId()}`;
const labelId = `label-${useId()}`;
const errorMessageId = `error-message-${useId()}`;

const canDecrement = computed(() => model.value > props.min);
const canIncrement = computed(() => model.value < props.max);

function increment() {
  if (canIncrement.value === false) {
    return;
  }

  model.value += props.step;
}

function decrement() {
  if (canDecrement.value === false) {
    return;
  }

  model.value -= props.step;
}
</script>

<style scoped>
@reference 'tailwindcss';

.app-quantity-input {
  @apply w-fit;
}

.app-quantity-input[data-has-error] {
  .input,
  .minus-button,
  .plus-button {
    @apply border-red-500 outline-red-500;
  }
}

.minus-button,
.plus-button {
  @apply flex items-center justify-center p-0.5 not-disabled:cursor-pointer disabled:cursor-auto;

  svg {
    @apply size-1.25;
  }
}

.minus-button {
  @apply rounded-l-md border border-gray-500;
}

.plus-button {
  @apply rounded-r-md border border-gray-500;
}

.input {
  @apply w-5 border-y border-gray-500 text-center text-lg font-medium;
}
</style>
