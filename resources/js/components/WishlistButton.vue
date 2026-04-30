<template>
  <AppIconButton
    :icon="wishlistIcon"
    variant="white"
    :size="size"
    :shape="shape"
    :title="wishlistIconTitle"
    :class="{ 'text-red-500': isWishlisted }"
    :href="isGuest ? route('account.auth.login.create') : undefined"
    @click="isAuthenticated && toggle()"
  />
</template>

<script lang="ts" setup>
import { route } from '@/types/helpers/route';
import { router, usePage } from '@inertiajs/vue3';
import { IconHeart, IconHeartFilled } from '@tabler/icons-vue';
import { computed } from 'vue';
import AppIconButton, { AppIconButtonProps } from './AppIconButton.vue';

const props = withDefaults(
  defineProps<{
    productId: string;
    size?: AppIconButtonProps['size'];
    shape?: AppIconButtonProps['shape'];
  }>(),
  {
    size: 'md',
    shape: 'circle',
  },
);

const page = usePage();

const isAuthenticated = computed(() => page.props.auth.isAuthenticated);
const isGuest = computed(() => page.props.auth.isGuest);
const isWishlisted = computed(() => page.props.auth.wishlist.includes(props.productId));
const wishlistIcon = computed(() => (isAuthenticated.value && isWishlisted.value ? IconHeartFilled : IconHeart));

const wishlistIconTitle = computed(() => {
  if (isGuest.value) {
    return 'Login to wishlist';
  }

  return isWishlisted.value ? 'Remove from wishlist' : 'Add to wishlist';
});

function toggle() {
  router.post(route('account.wishlist.toggle', { product: props.productId }), {}, { preserveScroll: true });
}
</script>
