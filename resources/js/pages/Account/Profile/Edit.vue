<template>
  <Head title="Edit Profile" />
  <div class="app-card w-full">
    <h1 class="app-account-heading mb-1.5">Edit Your Profile</h1>
    <Form
      v-slot="{ errors, processing, validate }"
      method="put"
      :action="route('account.profile.update')"
      class="space-y-1.5"
    >
      <div class="grid gap-1.5 md:grid-cols-2">
        <AppInput
          type="text"
          label="Name"
          name="name"
          :model-value="name"
          autocomplete="name"
          :error-message="errors.name"
          @change="validate('name')"
        />
        <AppInput
          label="E-mail"
          type="email"
          name="email"
          :model-value="email"
          autocomplete="email"
          :error-message="errors.email"
          @change="validate('email')"
        />
      </div>
      <AppInput
        label="Address"
        type="text"
        name="address"
        :model-value="address"
        autocomplete="address"
        :error-message="errors.address"
        @change="validate('address')"
      />
      <AppButton
        type="submit"
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
import { Form, Head } from '@inertiajs/vue3';

defineOptions({
  layout: AccountLayout,
});

defineProps<{
  name: string;
  email: string;
  address: string | null;
}>();
</script>
