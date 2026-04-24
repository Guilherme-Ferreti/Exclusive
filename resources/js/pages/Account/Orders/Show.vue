<template>
  <Head title="Order Details" />
  <div class="space-y-2">
    <div class="flex items-center justify-between">
      <div>
        <h2 class="text-lg font-semibold">Order {{ order.number }}</h2>
        <p class="text-sm text-gray-500">{{ order.orderedAt }}</p>
      </div>
      <AppBadge
        :label="order.status"
        :color="order.statusColor"
      />
    </div>
    <div class="space-y-1">
      <h3 class="font-medium">Items</h3>
      <AppTable>
        <template #header>
          <th>Product</th>
          <th>Price</th>
          <th>Qty</th>
          <th>Subtotal</th>
        </template>
        <tr
          v-for="item in order.items"
          :key="item.id"
        >
          <td class="font-medium">
            <BaseLink
              :href="route('products.show', { product: item.product.id })"
              class="hover:underline"
            >
              {{ item.product.name }}
            </BaseLink>
          </td>
          <td>{{ formatPrice(item.unitPrice) }}</td>
          <td>{{ item.quantity }}</td>
          <td>{{ formatPrice(item.subtotal) }}</td>
        </tr>
      </AppTable>
    </div>
    <div class="flex justify-end">
      <div class="text-right">
        <p class="text-sm text-gray-500">Total</p>
        <p class="text-xl font-semibold">{{ formatPrice(order.total) }}</p>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import AppBadge from '@/components/AppBadge.vue';
import AppTable from '@/components/AppTable.vue';
import BaseLink from '@/components/BaseLink.vue';
import AccountLayout from '@/layouts/AccountLayout.vue';
import { formatPrice } from '@/lib/utils';
import { route } from '@/types/helpers/route';
import { Head } from '@inertiajs/vue3';

defineOptions({
  layout: AccountLayout,
});

defineProps<{
  order: App.Data.Inertia.OrderShowData;
}>();
</script>
