<template>
  <Head title="Forgot Password" />
  <AuthForm
    title="Forgot password?"
    description="Enter your email to receive a reset link"
    :action="route('auth.forgot-password.store')"
  >
    <template #fields="{ errors }">
      <AppInput
        variant="underline"
        type="email"
        name="email"
        placeholder="Email"
        autocomplete="email"
        required
        :error-message="errors.email"
      />
    </template>
    <template #footer="{ processing }">
      <div class="mb-2 flex items-center justify-between">
        <AppButton
          type="submit"
          label="Send Reset Link"
          class="w-full"
          :disabled="processing"
        />
      </div>
      <p class="text-center opacity-70">
        Remember your password?
        <BaseLink
          title="Log in"
          class="pb-0.175 border-b font-medium hover:text-gray-500"
          :href="route('auth.login.create')"
        >
          Log in
        </BaseLink>
      </p>
    </template>
  </AuthForm>
</template>

<script setup lang="ts">
import AppButton from '@/components/AppButton.vue';
import AppInput from '@/components/AppInput.vue';
import AuthForm from '@/components/AuthForm.vue';
import BaseLink from '@/components/BaseLink.vue';
import { route } from '@/types/helpers/route';
import { Head } from '@inertiajs/vue3';
</script>
