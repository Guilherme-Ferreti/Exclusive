<script setup lang="ts">
import AppButton from '@/components/AppButton.vue';
import AppInput from '@/components/AppInput.vue';
import BaseLink from '@/components/BaseLink.vue';
</script>

<template>
  <form class="m-auto max-w-23 lg:mr-[unset]">
    <h1 class="app-title mb-1.5 font-medium">Create an account</h1>
    <p class="mb-3">Enter your details below</p>
    <div class="mb-2 w-full space-y-2.5">
      <AppInput
        variant="underline"
        type="text"
        name="name"
        placeholder="Name"
        autocomplete="name"
      />
      <AppInput
        variant="underline"
        type="text"
        name="emailOrPhoneNumber"
        placeholder="Email or Phone Number"
        autocomplete="email tel"
      />
      <AppInput
        variant="underline"
        type="password"
        name="password"
        placeholder="Password"
      />
    </div>
    <AppButton
      type="submit"
      variant="primary"
      class="mb-2 w-full"
      label="Create Account"
    />
    <p class="opacity-70">
      Already have an account?
      <BaseLink
        title="Log in"
        class="pb-0.175 border-b font-medium"
      >
        Log in
      </BaseLink>
    </p>
  </form>
</template>
