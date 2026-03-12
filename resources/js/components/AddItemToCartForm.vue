<template>
  <Form
    class="flex flex-wrap gap-1"
    method="post"
    :action="cart.items.store()"
    :transform="(data) => ({ ...data, productId })"
    disable-while-processing
    :options="{
      preserveScroll: true,
    }"
    #default="{ errors }"
  >
    <AppQuantityInput
      name="quantity"
      :min="1"
      :max="100"
      :step="1"
      placeholder="Item quantity"
      required
      :error-message="errors.quantity"
    />
    <AppButton
      label="Add to Cart"
      type="submit"
    />
  </Form>
</template>

<script lang="ts" setup>
import cart from '@/routes/cart';
import { Form } from '@inertiajs/vue3';
import AppButton from './AppButton.vue';
import AppQuantityInput from './AppQuantityInput.vue';

defineProps<{
  productId: string;
}>();
</script>
