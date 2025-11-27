<script setup lang="ts">
import AppButton from '@/components/AppButton.vue';
import AppInput from '@/components/AppInput.vue';
import BaseLink from '@/components/BaseLink.vue';
import signUp from '@/routes/auth/sign-up';
import { Form } from '@inertiajs/vue3';
</script>

<template>
  <div class="w-full md:grid md:grid-cols-[1fr_23rem] md:gap-4 lg:gap-7">
    <div class="hidden overflow-hidden rounded-sm md:block">
      <img
        src="/assets/images/auth-side-image.webp"
        alt=""
        class="h-full w-full object-cover"
      />
    </div>
    <Form
      :action="signUp.store()"
      method="post"
      class="m-auto w-full max-w-23 lg:mr-[unset]"
      #default="{ errors, processing }"
    >
      <h1 class="app-heading mb-1.5 font-medium">Create an account</h1>
      <p class="mb-3">Enter your details below</p>
      <div class="mb-2 space-y-2.5">
        <AppInput
          variant="underline"
          type="text"
          name="name"
          placeholder="Name"
          autocomplete="name"
          required
          :error-message="errors.name"
        />
        <AppInput
          variant="underline"
          type="email"
          name="email"
          placeholder="Email"
          autocomplete="email"
          required
          :error-message="errors.email"
        />
        <AppInput
          variant="underline"
          type="password"
          name="password"
          placeholder="Password"
          required
          :error-message="errors.password"
        />
      </div>
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
          class="pb-0.175 border-b font-medium"
        >
          Log in
        </BaseLink>
      </p>
    </Form>
  </div>
</template>
