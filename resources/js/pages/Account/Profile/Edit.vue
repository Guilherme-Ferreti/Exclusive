<template>
  <div class="app-card w-full">
    <h1 class="app-account-heading mb-1.5">Edit Your Profile</h1>
    <form class="space-y-1.5">
      <div class="grid gap-1.5 md:grid-cols-2">
        <AppInput
          type="text"
          label="Name"
          name="name"
          value="Name"
          autocomplete="name"
        />
        <AppInput
          label="E-mail"
          type="email"
          name="email"
          value="Email"
          autocomplete="email"
        />
      </div>
      <AppInput
        label="Address"
        type="text"
        name="address"
        value="Address"
        autocomplete="address"
      />
    </form>
  </div>
</template>

<script setup lang="ts">
import AppInput from '@/components/AppInput.vue';
import AccountLayout from '@/layouts/AccountLayout.vue';

defineOptions({
  layout: AccountLayout,
});
</script>
