<template>
  <Head title="Orders" />
  <AppTable v-if="orders.length > 0">
    <template #header>
      <th>Order Number</th>
      <th>Date</th>
      <th>Status</th>
      <th>Total</th>
      <th></th>
    </template>
    <tr
      v-for="order in orders"
      :key="order.id"
    >
      <td class="font-medium">{{ order.number }}</td>
      <td>{{ order.formattedCreatedAt }}</td>
      <td>
        <AppBadge
          :label="order.status"
          :color="order.statusColor"
        />
      </td>
      <td>${{ formatPrice(order.total) }}</td>
      <td>
        <BaseLink
          :href="account.orders.show({ orderId: order.id })"
          class="text-gray-600 hover:text-gray-900 text-sm hover:underline"
        >
          View
        </BaseLink>
      </td>
    </tr>
  </AppTable>
  <div
    v-else
    class="my-auto space-y-1.5 text-center"
  >
    No orders found
  </div>
</template>

<script setup lang="ts">
import AppBadge from '@/components/AppBadge.vue';
import AppTable from '@/components/AppTable.vue';
import BaseLink from '@/components/BaseLink.vue';
import AccountLayout from '@/layouts/AccountLayout.vue';
import { formatPrice } from '@/lib/utils';
import account from '@/routes/account';
import { Head } from '@inertiajs/vue3';

defineOptions({
  layout: AccountLayout,
});

defineProps<{
  orders: App.Data.Inertia.OrderPreview[];
}>();
</script>
