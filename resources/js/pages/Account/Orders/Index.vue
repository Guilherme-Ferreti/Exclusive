<template>
  <Head title="Orders" />
  <AppEmptyState
    v-if="orders.length === 0"
    title="You have no orders"
    description="You haven't placed any orders yet."
    :icon="IconShoppingBagDiscount"
  />
  <AppTable v-else>
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
      <td>{{ order.orderedAtDay }}</td>
      <td>
        <AppBadge
          :label="order.status"
          :color="order.statusColor"
        />
      </td>
      <td>{{ formatPrice(order.total) }}</td>
      <td>
        <BaseLink
          :href="route('account.orders.show', { orderId: order.id })"
          class="text-sm hover:underline"
        >
          View
        </BaseLink>
      </td>
    </tr>
  </AppTable>
</template>

<script setup lang="ts">
import AppBadge, { BadgeColor } from '@/components/AppBadge.vue';
import AppEmptyState from '@/components/AppEmptyState.vue';
import AppTable from '@/components/AppTable.vue';
import BaseLink from '@/components/BaseLink.vue';
import AccountLayout from '@/layouts/AccountLayout.vue';
import { formatPrice } from '@/lib/utils';
import { route } from '@/types/helpers/route';
import { Head } from '@inertiajs/vue3';
import { IconShoppingBagDiscount } from '@tabler/icons-vue';

defineOptions({
  layout: AccountLayout,
});

defineProps<{
  orders: {
    id: string;
    number: string;
    orderedAtDay: string;
    status: string;
    statusColor: BadgeColor;
    total: number;
  }[];
}>();
</script>
