<template>
  <nav
    class="w-full lg:hidden"
    aria-label="Main navigation"
  >
    <ul class="flex w-full items-center gap-1">
      <li>
        <BaseLink :href="home()">
          <AppLogo />
        </BaseLink>
      </li>
      <li class="w-full">
        <AppInput
          type="search"
          class="text-sm"
          placeholder="What are you looking for?"
          name="search"
          :icon="IconSearch"
          autocomplete="search"
        />
      </li>
      <NavLink
        label="Cart"
        :icon="IconShoppingCart"
        :href="home()"
      />
      <AppIconButton
        type="button"
        :icon="IconMenu2"
        :aria-expanded="isOpen"
        aria-label="Open sidebar"
        @click="toggle"
      />
    </ul>
    <div
      ref="mobile-nav-drawer"
      class="fixed top-0 -right-20 z-10 flex h-screen w-full max-w-20 flex-col bg-white transition-[right] duration-500 ease-in-out"
      :class="{
        'right-0': isOpen,
      }"
      :inert="!isOpen"
    >
      <div class="flex w-full items-center justify-between p-1">
        <AppLogo />
        <AppIconButton
          type="button"
          :icon="IconX"
          :aria-expanded="isOpen"
          aria-label="Close sidebar"
          @click="toggle"
        />
      </div>
      <ul>
        <NavLinkBorderReveal
          :href="aboutUs()"
          label="About"
        />
        <NavLinkBorderReveal
          :href="contact.create()"
          label="Contact"
        />
        <NavLinkBorderReveal
          :href="signUp.create()"
          label="Sign Up"
        />
        <div class="flex justify-center gap-1 p-1">
          <NavLink
            label="Wishlist"
            :icon="IconHeart"
            :href="home()"
          />
          <NavLink
            label="Cart"
            :icon="IconShoppingCart"
            :href="home()"
          />
          <NavLink
            label="Account"
            :icon="IconUser"
            :href="home()"
          />
        </div>
      </ul>
    </div>
  </nav>
</template>

<script setup lang="ts">
import { aboutUs, home } from '@/routes';
import signUp from '@/routes/auth/sign-up';
import contact from '@/routes/contact';
import { useLayoutStore } from '@/stores/layout';
import { IconHeart, IconMenu2, IconSearch, IconShoppingCart, IconUser, IconX } from '@tabler/icons-vue';
import { useFocusTrap } from '@vueuse/integrations/useFocusTrap';
import { nextTick, ref, useTemplateRef } from 'vue';
import AppIconButton from './AppIconButton.vue';
import AppInput from './AppInput.vue';
import AppLogo from './AppLogo.vue';
import BaseLink from './BaseLink.vue';
import NavLink from './NavLink.vue';
import NavLinkBorderReveal from './NavLinkBorderReveal.vue';

const isOpen = ref(false);
const layoutStore = useLayoutStore();

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
