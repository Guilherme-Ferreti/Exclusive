<template>
  <AuthForm
    title="Create an account"
    description="Enter your details below"
    :action="signUp.store()"
  >
    <template #fields="{ errors, validate }">
      <AppInput
        variant="underline"
        type="text"
        name="name"
        placeholder="Name"
        autocomplete="name"
        required
        :error-message="errors.name"
        @change="validate('name')"
      />
      <AppInput
        variant="underline"
        type="email"
        name="email"
        placeholder="Email"
        autocomplete="email"
        required
        :error-message="errors.email"
        @change="validate('email')"
      />
      <AppPasswordInput
        name="password"
        placeholder="Password"
        required
        :error-message="errors.password"
        @change="validate('password')"
      />
    </template>
    <template #footer="{ processing }">
      <AppButton
        type="submit"
        variant="primary"
        class="mb-2 w-full"
        label="Create Account"
        :disabled="processing"
      />
      <p class="text-center opacity-70">
        Already have an account?
        <BaseLink
          title="Log in"
          class="pb-0.175 border-b font-medium hover:text-gray-500"
          :href="login.create()"
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
import AppPasswordInput from '@/components/AppPasswordInput.vue';
import AuthForm from '@/components/AuthForm.vue';
import BaseLink from '@/components/BaseLink.vue';
import login from '@/routes/auth/login';
import signUp from '@/routes/auth/sign-up';
</script>
