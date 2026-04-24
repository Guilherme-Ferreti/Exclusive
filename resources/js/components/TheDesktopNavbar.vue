<template>
  <nav
    class="hidden items-center gap-3 lg:flex"
    aria-label="Main navigation"
  >
    <AppLogo />
    <ul class="flex w-full items-center">
      <NavLink
        :href="route('home')"
        label="Home"
        class="mr-2"
      />
      <NavLink
        :href="route('about-us')"
        label="About"
        class="mr-2"
      />
      <NavLink
        :href="route('contact')"
        label="Contact"
        class="mr-2"
      />
      <NavLink
        v-if="$page.props.auth.isGuest"
        :href="route('auth.sign-up.create')"
        label="Sign Up"
        class="mr-2"
      />
      <li class="mr-2 ml-auto min-w-16">
        <SearchBar />
      </li>
      <NavLink
        label="Wishlist"
        :icon="IconHeart"
        :href="route('account.wishlist')"
        class="mr-0.5"
      />
      <NavCartLink class="mr-0.5" />
      <NavLink
        v-if="$page.props.auth.isGuest"
        label="Log in"
        :icon="IconLogin2"
        :href="route('auth.login.create')"
      />
      <li v-if="$page.props.auth.isAuthenticated">
        <AppContextMenu
          anchor-classes="flex size-2.5 items-center justify-center rounded-full hover:bg-red-500 hover:text-white"
          open-anchor-classes="bg-red-500 text-white"
          label="My Account"
          :icon="IconUser"
        >
          <AppContextMenuItem
            label="My Profile"
            :href="route('account.profile.edit')"
            :icon="IconUser"
          />
          <AppContextMenuItem
            label="Orders"
            :href="route('account.orders.index')"
            :icon="IconShoppingBag"
          />
          <AppContextMenuItem
            label="Logout"
            :href="route('auth.login.destroy')"
            method="post"
            :icon="IconLogout2"
          />
        </AppContextMenu>
      </li>
    </ul>
  </nav>
</template>

<script setup lang="ts">
import { route } from '@/types/helpers/route';
import { IconHeart, IconLogin2, IconLogout2, IconShoppingBag, IconUser } from '@tabler/icons-vue';
import AppContextMenu from './AppContextMenu.vue';
import AppContextMenuItem from './AppContextMenuItem.vue';
import AppLogo from './AppLogo.vue';
import NavCartLink from './NavCartLink.vue';
import NavLink from './NavLink.vue';
import SearchBar from './SearchBar.vue';
</script>
