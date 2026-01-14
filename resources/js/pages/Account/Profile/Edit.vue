<template>
  <div class="app-card w-full">
    <h1 class="app-account-heading mb-1.5">Edit Your Profile</h1>
    <Form
      method="post"
      :action="account.profile.update()"
      class="space-y-1.5"
      #default="{ errors, processing, validate }"
    >
      <div class="grid gap-1.5 md:grid-cols-2">
        <AppInput
          type="text"
          label="Name"
          name="name"
          :value="name"
          autocomplete="name"
          :error-message="errors.name"
          @change="validate('name')"
        />
        <AppInput
          label="E-mail"
          type="email"
          name="email"
          :value="email"
          autocomplete="email"
          :error-message="errors.email"
          @change="validate('email')"
        />
      </div>
      <AppInput
        label="Address"
        type="text"
        name="address"
        :value="address"
        autocomplete="address"
        :error-message="errors.address"
        @change="validate('address')"
      />
      <AppButton
        type="submit"
        variant="primary"
        label="Save"
        :disabled="processing"
      />
    </Form>
  </div>
</template>

<script setup lang="ts">
import AppButton from '@/components/AppButton.vue';
import AppInput from '@/components/AppInput.vue';
import AccountLayout from '@/layouts/AccountLayout.vue';
import account from '@/routes/account';
import { Form } from '@inertiajs/vue3';

defineOptions({
  layout: AccountLayout,
});

defineProps<{
  name: string;
  email: string;
  address: string | null;
}>();
</script>
