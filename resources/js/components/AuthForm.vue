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
      :action="action"
      method="post"
      class="m-auto w-full max-w-23 lg:mr-[unset]"
      #default="{ errors, processing }"
      :options="{
        preserveScroll: true,
      }"
    >
      <h1 class="app-heading mb-1.5 font-medium">{{ title }}</h1>
      <p class="mb-3">{{ description }}</p>
      <div class="mb-2 space-y-2.5">
        <slot
          name="fields"
          :errors="errors"
        />
      </div>
      <slot
        name="footer"
        :processing="processing"
      />
    </Form>
  </div>
</template>

<script setup lang="ts">
import { RouteDefinition } from '@/wayfinder';
import { Form } from '@inertiajs/vue3';

defineProps<{
  title: string;
  description: string;
  action: RouteDefinition<'post'>;
}>();
</script>
