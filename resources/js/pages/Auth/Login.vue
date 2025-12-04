<template>
  <AuthForm
    :title="`Log in to ${$page.props.name}`"
    description="Enter your details below"
    :action="login.store()"
    :reset-on-error="['password']"
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
      <AppPasswordInput
        name="password"
        placeholder="Password"
        required
        :error-message="errors.password"
      />
    </template>
    <template #footer="{ processing }">
      <div class="mb-2 flex items-center justify-between">
        <AppButton
          type="submit"
          variant="primary"
          label="Log In"
          :disabled="processing"
        />
        <BaseLink
          href="/"
          class="text-red-500 hover:text-red-300"
          >Forget password?</BaseLink
        >
      </div>
      <p class="text-center opacity-70">
        Don't have an account?
        <BaseLink
          title="Log in"
          class="pb-0.175 border-b font-medium hover:text-gray-500"
          :href="signUp.create()"
        >
          Sign up
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
