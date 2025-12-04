<template>
  <AppInput
    variant="underline"
    :type="type"
    :name="name"
    :placeholder="placeholder"
    :required="required"
    :error-message="errorMessage"
    :icon-right="rightIcon.icon"
    icon-right-type="button"
    icon-right-title="Reveal password"
    :icon-right-pressed="rightIcon.pressed"
    @icon-right-click="togglePasswordVisibility"
  />
</template>

<script setup lang="ts">
import AppInput from '@/components/AppInput.vue';
import { InputVariant } from '@/types/input';
import { IconEye, IconEyeOff } from '@tabler/icons-vue';
import { computed, ref } from 'vue';

defineProps<{
  name: string;
  placeholder?: string;
  required?: boolean;
  errorMessage?: string;
  variant?: InputVariant;
}>();

const type = ref<'text' | 'password'>('password');

const rightIcon = computed(() => {
  return {
    icon: type.value === 'password' ? IconEye : IconEyeOff,
    pressed: type.value === 'text',
  };
});

function togglePasswordVisibility() {
  type.value = type.value === 'password' ? 'text' : 'password';
}
</script>
