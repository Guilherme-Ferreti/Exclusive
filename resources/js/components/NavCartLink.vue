<template>
  <AppIndicator>
    <template #item>
      <AppNumericBadge
        v-if="showBadge"
        :number="cartItemsCount"
      />
    </template>
    <NavLink
      label="Cart"
      :icon="IconShoppingCart"
      :href="route('cart.show')"
    />
  </AppIndicator>
</template>

<script lang="ts" setup>
import { getBasePath } from '@/helpers/utils';
import { usePage } from '@inertiajs/vue3';
import { IconShoppingCart } from '@tabler/icons-vue';
import { computed } from 'vue';
import AppIndicator from './AppIndicator.vue';
import AppNumericBadge from './AppNumericBadge.vue';
import NavLink from './NavLink.vue';

const page = usePage();

const cartItemsCount = computed(() => page.props.auth.cartItems?.reduce((total, item) => total + item.quantity, 0) || 0);
const showBadge = computed(() => cartItemsCount.value > 0 && getBasePath(page.url) !== getBasePath(route('cart.show')));
</script>
