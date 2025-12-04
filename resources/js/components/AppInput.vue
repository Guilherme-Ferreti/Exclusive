<template>
  <div
    class="app-input"
    :data-variant="`${variant || 'default'}`"
    :data-has-error="typeof errorMessage === 'string' ? true : undefined"
  >
    <div class="input-wrapper | relative inline-block w-full">
      <button
        v-if="iconLeft && iconLeftType"
        class="icon-button icon-left"
        :type="iconLeftType"
        :title="iconLeftTitle"
        :aria-label="iconLeftTitle"
        @click="$emit('iconLeftClick')"
      >
        <component
          :is="iconLeft"
          role="presentation"
        />
      </button>
      <component
        v-if="iconLeft && !iconLeftType"
        :is="iconLeft"
        class="icon-left"
        role="presentation"
      />
      <input
        class="w-full py-0.5"
        :type="type"
        :name="name"
        :placeholder="placeholder"
        :autocomplete="autocomplete"
        :required="required"
        :aria-invalid="!!errorMessage"
        :aria-errormessage="errorMessageId"
      />
      <button
        v-if="iconRight && iconRightType"
        class="icon-button icon-right"
        :type="iconRightType"
        :title="iconRightTitle"
        :aria-label="iconRightTitle"
        @click="$emit('iconRightClick')"
      >
        <component
          :is="iconRight"
          role="presentation"
        />
      </button>
      <component
        v-if="iconRight && !iconRightType"
        class="icon-right"
        :is="iconRight"
        role="presentation"
      />
    </div>
    <p
      v-if="errorMessage"
      :id="errorMessageId"
      class="mt-0.5 text-sm text-red-500"
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
import { useId } from 'vue';

defineProps<{
  type: HTMLInputElement['type'];
  name?: string;
  variant?: `${InputVariant}`;
  errorMessage?: string;
  placeholder?: string;
  autocomplete?: string;
  required?: boolean;
  iconLeft?: Icon;
  iconLeftType?: HTMLButtonElement['type'];
  iconLeftTitle?: string;
  iconRight?: Icon;
  iconRightType?: HTMLButtonElement['type'];
  iconRightTitle?: string;
}>();

defineEmits<{
  iconLeftClick: [];
  iconRightClick: [];
}>();

const errorMessageId = useId();
</script>

<style scoped>
@reference 'tailwindcss';

.app-input {
  --horizontal-padding: calc(var(--spacing) * 0.75);
  --icon-width: 1.5rem;

  &[data-has-error] input {
    @apply outline-red-500;
  }
}

.icon-left,
.icon-right {
  @apply absolute top-1/2 -translate-y-1/2;
}

.icon-button {
  @apply cursor-pointer p-0.25;
}

/** Default variant */
.app-input[data-variant='default'] {
  --padding-on-icon-side: calc(var(--horizontal-padding) + var(--icon-width) + var(--horizontal-padding));

  input {
    @apply bg-gray-300;
  }

  .icon-left {
    @apply left-(--horizontal-padding);
  }

  .icon-right {
    @apply right-(--horizontal-padding);
  }

  &:has(.icon-left) input {
    @apply pr-(--horizontal-padding) pl-(--padding-on-icon-side);
  }

  &:has(.icon-right) input {
    @apply pr-(--padding-on-icon-side) pl-(--horizontal-padding);
  }

  &[data-has-error] .input-wrapper {
    @apply border border-red-500;
  }
}

/** Underline variant */
.app-input[data-variant='underline'] {
  --padding-on-icon-side: calc(var(--horizontal-padding) + var(--icon-width));

  input {
    @apply border-b border-gray-500 outline-offset-3;
  }

  .icon-left {
    @apply left-0;
  }

  .icon-right {
    @apply right-0;
  }

  &:has(.icon-left) input {
    @apply pl-(--padding-on-icon-side);
  }

  &:has(.icon-right) input {
    @apply pr-(--padding-on-icon-side);
  }

  &[data-has-error] input {
    @apply border border-red-500;
  }
}
</style>
