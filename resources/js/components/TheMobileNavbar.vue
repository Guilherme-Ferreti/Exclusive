<template>
  <nav
    class="w-full lg:hidden"
    aria-label="Main navigation"
  >
    <ul>
      <div class="flex w-full items-center gap-1">
        <li>
          <BaseLink :href="route('home')">
            <AppLogo />
          </BaseLink>
        </li>
        <li class="hidden w-full sm:block">
          <SearchBar />
        </li>
        <NavCartLink class="ml-auto" />
        <AppIconButton
          :icon="IconMenu2"
          :aria-expanded="isOpen"
          aria-label="Open sidebar"
          @click="toggle"
        />
      </div>
      <li class="mt-0.5 sm:hidden">
        <SearchBar />
      </li>
    </ul>
    <div
      ref="mobile-nav-drawer"
      class="fixed top-0 -right-20 z-10 h-screen w-full max-w-20 bg-white transition-[right] duration-500 ease-in-out"
      :class="{
        'right-0': isOpen,
      }"
      :inert="!isOpen"
    >
      <div class="app-container | space-y-(--padding-inline) py-(--padding-inline)">
        <div class="flex w-full items-center justify-between">
          <AppLogo />
          <AppIconButton
            :icon="IconX"
            :aria-expanded="isOpen"
            aria-label="Close sidebar"
            @click="toggle"
          />
        </div>
        <p v-if="$page.props.auth.isAuthenticated">
          Welcome <span class="text-red-500">{{ $page.props.auth.user.name }}!</span>
        </p>
        <ul class="full-width">
          <NavLinkBorderReveal
            v-for="link in dynamicLinks"
            :key="link.label"
            :label="link.label"
            :icon="link.icon"
            :href="link.href"
            :method="link.method"
            :as="link.as"
            @click="toggle"
          />
        </ul>
      </div>
    </div>
  </nav>
</template>

<script setup lang="ts">
import { useLayoutStore } from '@/stores/layout';
import { route } from '@/types/helpers/route';
import { InertiaLinkProps, usePage } from '@inertiajs/vue3';
import {
  IconHeart,
  IconLogin2,
  IconLogout2,
  IconMenu2,
  IconQuestionMark,
  IconShoppingBag,
  IconShoppingCart,
  IconSpeakerphone,
  IconUser,
  IconUserPlus,
  IconX,
} from '@tabler/icons-vue';
import { useFocusTrap } from '@vueuse/integrations/useFocusTrap';
import { computed, nextTick, ref, useTemplateRef } from 'vue';
import AppIconButton from './AppIconButton.vue';
import AppLogo from './AppLogo.vue';
import BaseLink from './BaseLink.vue';
import NavCartLink from './NavCartLink.vue';
import NavLinkBorderReveal from './NavLinkBorderReveal.vue';
import SearchBar from './SearchBar.vue';

const isOpen = ref(false);
const layoutStore = useLayoutStore();
const page = usePage();

const dynamicLinks = computed(() =>
  page.props.auth.isGuest
    ? [
        {
          label: 'Login',
          icon: IconLogin2,
          href: route('auth.login.create'),
        },
        {
          label: 'Sign Up',
          icon: IconUserPlus,
          href: route('auth.sign-up.create'),
        },
        {
          label: 'Contact',
          icon: IconSpeakerphone,
          href: route('contact'),
        },
        {
          label: 'About Us',
          icon: IconQuestionMark,
          href: route('about-us'),
        },
      ]
    : [
        {
          label: 'Cart',
          icon: IconShoppingCart,
          href: route('cart.show'),
        },
        {
          label: 'Wishlist',
          icon: IconHeart,
          href: route('account.wishlist'),
        },
        {
          label: 'Orders',
          icon: IconShoppingBag,
          href: route('account.orders.index'),
        },
        {
          label: 'My Profile',
          icon: IconUser,
          href: route('account.profile.edit'),
        },
        {
          label: 'Contact',
          icon: IconSpeakerphone,
          href: route('contact'),
        },
        {
          label: 'About Us',
          icon: IconQuestionMark,
          href: route('about-us'),
        },
        {
          label: 'Logout',
          icon: IconLogout2,
          href: route('auth.login.destroy'),
          method: 'post' as InertiaLinkProps['method'],
          as: 'button',
        },
      ],
);

const drawerRef = useTemplateRef<HTMLDivElement>('mobile-nav-drawer');
const focusTrap = useFocusTrap(drawerRef, {
  allowOutsideClick: true,
});

function toggle() {
  if (isOpen.value) {
    isOpen.value = false;
    focusTrap.deactivate();
    setTimeout(() => layoutStore.hideOverlay(), 500);
  } else {
    isOpen.value = true;
    layoutStore.showOverlay();
    nextTick(() => focusTrap.activate());
  }
}
</script>
