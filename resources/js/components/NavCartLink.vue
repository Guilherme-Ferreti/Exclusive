<template>
  <AppIndicator>
    <template #item>
      <AppNumericBadge
        v-if="showBadge"
        :number="page.props.auth.cartItemsCount"
      />
    </template>
    <NavLink
      label="Cart"
      :icon="IconShoppingCart"
      :href="cart.index()"
    />
  </AppIndicator>
</template>

<script lang="ts" setup>
import { getBasePath } from '@/helpers/utils';
import cart from '@/routes/cart';
import { usePage } from '@inertiajs/vue3';
import { IconShoppingCart } from '@tabler/icons-vue';
import { computed } from 'vue';
import AppIndicator from './AppIndicator.vue';
import AppNumericBadge from './AppNumericBadge.vue';
import NavLink from './NavLink.vue';

const page = usePage();

const showBadge = computed(() => page.props.auth.cartItemsCount > 0 && getBasePath(page.url) !== getBasePath(cart.index().url));
</script>
