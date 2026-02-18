<template>
  <AppIconButton
    :icon="wishlistIcon"
    variant="white"
    size="sm"
    shape="circle"
    :title="wishlistIconTitle"
    :class="{ 'text-red-500': isWishlisted }"
    :href="isGuest ? auth.login.create() : undefined"
    @click="isAuthenticated && toggle()"
  />
</template>

<script lang="ts" setup>
import account from '@/routes/account';
import auth from '@/routes/auth';
import { router, usePage } from '@inertiajs/vue3';
import { IconHeart, IconHeartFilled } from '@tabler/icons-vue';
import { computed } from 'vue';
import AppIconButton from './AppIconButton.vue';

const props = defineProps<{
  productId: string;
}>();

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
  router.post(account.wishlist.toggle(), { productId: props.productId }, { preserveScroll: true });
}
</script>
