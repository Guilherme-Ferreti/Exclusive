<template>
  <Form
    v-slot="{ errors }"
    class="flex flex-wrap gap-1"
    method="post"
    :action="route('cart.items.store')"
    :transform="(data) => ({ ...data, productId })"
    disable-while-processing
    :options="{
      preserveScroll: true,
    }"
  >
    <AppQuantityInput
      name="quantity"
      :min="1"
      :max="100"
      :step="1"
      :model-value="quantity"
      placeholder="Item quantity"
      required
      :error-message="errors.quantity"
    />
    <AppButton
      :label="alreadyInCart ? 'Update Cart' : 'Add to Cart'"
      type="submit"
    />
  </Form>
</template>

<script lang="ts" setup>
import { route } from '@/types/helpers/route';
import { Form, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import AppButton from './AppButton.vue';
import AppQuantityInput from './AppQuantityInput.vue';

const props = defineProps<{
  productId: string;
}>();

const page = usePage();

const alreadyInCart = computed(() => page.props.auth.cartItems?.some((item) => item.productId === props.productId) || false);
const quantity = computed(() => page.props.auth.cartItems?.find((item) => item.productId === props.productId)?.quantity || 1);
</script>
