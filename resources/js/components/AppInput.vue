<template>
  <div
    class="app-input space-y-0.5"
    :data-variant="variant"
    :data-has-error="typeof errorMessage === 'string' ? true : undefined"
  >
    <AppInputLabel
      v-if="label"
      :for="inputId"
      :content="label"
    />
    <div class="input-wrapper | relative inline-block w-full">
      <button
        v-if="iconLeft && iconLeftType"
        class="icon-button icon-left"
        :type="iconLeftType"
        :title="iconLeftTitle"
        :aria-label="iconLeftTitle"
        :aria-pressed="iconLeftPressed ? true : undefined"
        @click="$emit('iconLeftClick')"
      >
        <AppIcon
          :icon="iconLeft"
          role="presentation"
        />
      </button>
      <AppIcon
        v-if="iconLeft && !iconLeftType"
        class="icon-left"
        :icon="iconLeft"
        role="presentation"
      />
      <input
        :id="inputId"
        v-model="model"
        class="h-2.5 w-full"
        :type="type"
        :name="name"
        :placeholder="placeholder"
        :autocomplete="autocomplete"
        :required="required"
        :aria-invalid="!!errorMessage"
        :aria-errormessage="errorMessageId"
        @change="$emit('change')"
      />
      <button
        v-if="iconRight && iconRightType"
        class="icon-button icon-right"
        :type="iconRightType"
        :title="iconRightTitle"
        :aria-label="iconRightTitle"
        :aria-pressed="iconRightPressed ? true : undefined"
        @click="$emit('iconRightClick')"
      >
        <AppIcon
          :icon="iconRight"
          role="presentation"
        />
      </button>
      <AppIcon
        v-if="iconRight && !iconRightType"
        class="icon-right"
        :icon="iconRight"
        role="presentation"
      />
    </div>
    <AppInputErrorMessage
      v-if="errorMessage"
      :id="errorMessageId"
      :content="errorMessage"
    />
  </div>
</template>

<script lang="ts">
interface Props {
  type: HTMLInputElement['type'];
  name: string;
  label?: string;
  variant?: `${InputVariant}`;
  errorMessage?: string;
  placeholder?: string;
  autocomplete?: string;
  required?: boolean;
  iconLeft?: Icon;
  iconLeftType?: HTMLButtonElement['type'];
  iconLeftTitle?: string;
  iconLeftPressed?: boolean;
  iconRight?: Icon;
  iconRightType?: HTMLButtonElement['type'];
  iconRightTitle?: string;
  iconRightPressed?: boolean;
}
</script>

<script setup lang="ts">
import { InputVariant } from '@/types/Input';
import { type Icon } from '@tabler/icons-vue';
import { useId } from 'vue';
import AppIcon from './AppIcon.vue';
import AppInputErrorMessage from './AppInputErrorMessage.vue';
import AppInputLabel from './AppInputLabel.vue';

const model = defineModel<string | number>();

withDefaults(defineProps<Props>(), {
  variant: 'default',
});

defineEmits<{
  change: [];
  iconLeftClick: [];
  iconRightClick: [];
}>();

const inputId = `input-${useId()}`;
const errorMessageId = `error-message-${useId()}`;
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
  @apply cursor-pointer;
}

/** Default variant */
.app-input[data-variant='default'] {
  --padding-on-icon-side: calc(var(--horizontal-padding) + var(--icon-width) + var(--horizontal-padding));

  input {
    @apply bg-gray-300 px-(--horizontal-padding);
  }

  .icon-left {
    @apply left-(--horizontal-padding);
  }

  .icon-right {
    @apply right-(--horizontal-padding);
  }

  &:has(.icon-left) input {
    @apply pl-(--padding-on-icon-side);
  }

  &:has(.icon-right) input {
    @apply pr-(--padding-on-icon-side);
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

/** Outline variant */
.app-input[data-variant='outline'] {
  --padding-on-icon-side: calc(var(--horizontal-padding) + var(--icon-width) + var(--horizontal-padding));

  input {
    @apply rounded-sm border border-black/40 px-(--horizontal-padding);
  }

  .icon-left {
    @apply left-(--horizontal-padding);
  }

  .icon-right {
    @apply right-(--horizontal-padding);
  }

  &:has(.icon-left) input {
    @apply pl-(--padding-on-icon-side);
  }

  &:has(.icon-right) input {
    @apply pr-(--padding-on-icon-side);
  }

  &[data-has-error] .input-wrapper {
    @apply border border-red-500;
  }
}
</style>
