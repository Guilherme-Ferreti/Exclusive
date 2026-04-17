<template>
  <AppBreadcrumbs
    :breadcrumbs="[
      {
        name: 'Home',
        href: home(),
        isActive: false,
      },
      {
        name: 'Cart',
        href: cartRoute.show(),
        isActive: true,
      },
    ]"
  />
  <template v-if="cart.items.length > 0">
    <Form
      :action="cartRoute.items.sync()"
      method="put"
      class="space-y-1.5"
      disable-while-processing
      :options="{
        preserveScroll: true,
      }"
      :transform="
        (data: any) => ({
          items: Object.keys(data.items).map((key: string) => ({ productId: key, quantity: data.items[key].quantity })),
        })
      "
    >
      <div class="relative flex w-full flex-col overflow-auto">
        <table class="w-full min-w-max table-auto border-separate border-spacing-y-1.5 overflow-scroll text-left">
          <thead>
            <tr class="rounded-sm shadow-sm">
              <th class="cart__header-cell">Product</th>
              <th class="cart__header-cell">Price</th>
              <th class="cart__header-cell">Quantity</th>
              <th class="cart__header-cell">Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="item in cart.items"
              :key="item.id"
              class="rounded-sm shadow-sm"
            >
              <td class="cart__body-cell">
                <div class="flex w-fit items-center gap-1">
                  <AppZoomableImage
                    :src="item.product.previewImage"
                    :alt="item.product.name"
                    :detail-url="item.product.detailImage"
                    class="w-4"
                  />
                  <BaseLink
                    :href="products.show(item.product.id)"
                    class="hover:text-gray-500 hover:underline"
                  >
                    {{ item.product.name }}
                  </BaseLink>
                </div>
              </td>
              <td class="cart__body-cell">{{ formatPrice(item.product.currentPrice) }}</td>
              <td class="cart__body-cell">
                <AppQuantityInput
                  :model-value="item.quantity"
                  :min="1"
                  :max="100"
                  :step="1"
                  :name="`items.${item.product.id}.quantity`"
                  :aria-label="`Quantity for ${item.product.name}`"
                />
              </td>
              <td class="cart__body-cell">{{ formatPrice(item.subtotal) }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="m-auto flex w-fit flex-col justify-between gap-1.5 sm:w-full sm:flex-row">
        <AppButton
          :href="home()"
          label="Return to Shop"
          variant="outline"
        />
        <AppButton
          type="submit"
          label="Update Cart"
          variant="outline"
        />
      </div>
    </Form>
    <div class="ml-auto grid w-full max-w-30 space-y-1 rounded-sm border border-black p-1.5">
      <p class="mb-1.5 text-lg font-semibold">Cart Total</p>
      <p class="cart-total__line">
        <span>Subtotal:</span>
        <span>{{ formatPrice(cart.subtotal) }}</span>
      </p>
      <hr class="app-divider" />
      <p class="cart-total__line">
        <span>Shipping:</span>
        <span>{{ cart.shippingCosts === 0 ? 'Free' : formatPrice(cart.shippingCosts) }}</span>
      </p>
      <hr class="app-divider" />
      <p class="cart-total__line">
        <span>Total:</span>
        <span>{{ formatPrice(cart.total) }}</span>
      </p>
      <AppButton
        type="button"
        label="Place Order"
        class="mx-auto"
        @click="() => router.post(cartRoute.checkout())"
      />
    </div>
  </template>
  <template v-else>
    <div class="my-auto space-y-1.5 text-center">
      <p>Your cart is empty. Add items to your cart to place an order!</p>
      <AppButton
        :href="home()"
        label="Return to Shop"
        variant="outline"
      />
    </div>
  </template>
</template>

<script lang="ts" setup>
import AppBreadcrumbs from '@/components/AppBreadcrumbs.vue';
import AppButton from '@/components/AppButton.vue';
import AppQuantityInput from '@/components/AppQuantityInput.vue';
import AppZoomableImage from '@/components/AppZoomableImage.vue';
import BaseLink from '@/components/BaseLink.vue';
import { formatPrice } from '@/lib/utils';
import { home } from '@/routes';
import cartRoute from '@/routes/cart';
import products from '@/routes/products';
import { Form, router } from '@inertiajs/vue3';

defineProps<{
  cart: App.Data.Inertia.Cart;
}>();
</script>

<style scoped>
@reference 'tailwindcss';

.cart__header-cell {
  @apply p-1.5 font-normal;
}

.cart__body-cell {
  @apply p-1.5;
}

.cart-total__line {
  @apply flex justify-between;
}
</style>
