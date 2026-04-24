<template>
  <Head title="Reset Password" />
  <AuthForm
    title="Reset Password"
    description="Enter your new password below"
    :action="route('auth.reset-password.store')"
    :reset-on-error="['password', 'passwordConfirmation']"
  >
    <template #fields="{ errors }">
      <input
        type="hidden"
        name="token"
        :value="token"
      />
      <input
        type="hidden"
        name="email"
        :value="email"
      />
      <AppPasswordInput
        variant="underline"
        name="password"
        placeholder="New Password"
        required
        :error-message="errors.password"
      />
      <AppPasswordInput
        variant="underline"
        name="passwordConfirmation"
        placeholder="Confirm Password"
        required
        :error-message="errors.passwordConfirmation"
      />
    </template>
    <template #footer="{ processing }">
      <AppButton
        type="submit"
        class="w-full"
        label="Reset Password"
        :disabled="processing"
      />
    </template>
  </AuthForm>
</template>

<script setup lang="ts">
import AppButton from '@/components/AppButton.vue';
import AppPasswordInput from '@/components/AppPasswordInput.vue';
import AuthForm from '@/components/AuthForm.vue';
import { route } from '@/types/helpers/route';
import { Head } from '@inertiajs/vue3';

defineProps<{
  email: string;
  token: string;
}>();
</script>
