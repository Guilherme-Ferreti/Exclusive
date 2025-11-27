<template>
  <div
    class="app-input"
    :data-variant="`${variant || 'default'}`"
    :data-has-error="typeof errorMessage === 'string' ? true : undefined"
  >
    <div class="app-input__input-wrapper">
      <component
        v-if="icon"
        :is="icon"
        class="app-input__icon"
      />
      <input
        class="app-input__input"
        :type="type"
        :name="name"
        :placeholder="placeholder"
        :autocomplete="autocomplete"
        :required="required"
      />
    </div>
    <p
      v-if="errorMessage"
      class="app-input__error-message"
    >
      {{ errorMessage }}
    </p>
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
  icon?: Icon;
  variant?: `${InputVariant}`;
  errorMessage?: string;
  placeholder?: string;
  autocomplete?: string;
  required?: boolean;
}>();
</script>

<style scoped>
@reference 'tailwindcss';

/* Default classes */
.app-input__input-wrapper {
  @apply relative inline-block w-full;
}

.app-input__icon {
  @apply absolute top-1/2 right-0.75 -translate-y-1/2;
}

.app-input__input {
  @apply w-full py-0.5;
}

.app-input__error-message {
  @apply mt-0.5 text-sm text-red-500;
}

.app-input[data-has-error] .app-input__input {
  @apply outline-red-500;
}

/** Default variant */
.app-input[data-variant='default'] .app-input__input {
  @apply bg-gray-300 pr-3 pl-0.75;
}

.app-input[data-variant='default'][data-has-error] .app-input__input-wrapper {
  @apply border border-red-500;
}

/** Underline variant */
.app-input[data-variant='underline'] .app-input__input {
  @apply border-b border-gray-500 outline-offset-3;
}

.app-input[data-variant='underline'][data-has-error] .app-input__input {
  @apply border-red-500;
}
</style>
