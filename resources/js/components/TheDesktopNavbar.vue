<template>
  <nav
    class="hidden items-center gap-3 lg:flex"
    aria-label="Main navigation"
  >
    <AppLogo />
    <ul class="flex w-full items-center">
      <NavLink
        :href="home()"
        label="Home"
        class="mr-2"
      />
      <NavLink
        :href="aboutUs()"
        label="About"
        class="mr-2"
      />
      <NavLink
        :href="contact.create()"
        label="Contact"
        class="mr-2"
      />
      <NavLink
        v-if="$page.props.auth.isGuest"
        :href="auth.signUp.create()"
        label="Sign Up"
        class="mr-2"
      />
      <li class="mr-2 ml-auto">
        <Form>
          <AppInput
            type="search"
            class="min-w-16 text-sm"
            placeholder="What are you looking for?"
            name="search"
            autocomplete="search"
            :icon-right="IconSearch"
            icon-right-type="submit"
            icon-right-title="Search"
          />
        </Form>
      </li>
      <NavLink
        label="Wishlist"
        :icon="IconHeart"
        :href="account.wishlist()"
        class="mr-0.5"
      />
      <NavLink
        label="Cart"
        :icon="IconShoppingCart"
        :href="account.cart()"
        class="mr-0.5"
      />
      <NavLink
        v-if="$page.props.auth.isGuest"
        label="Log in"
        :icon="IconLogin2"
        :href="auth.login.create()"
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
            :href="account.profile.edit()"
            :icon="IconUser"
          />
          <AppContextMenuItem
            label="Orders"
            :href="account.orders.index()"
            :icon="IconShoppingBag"
          />
          <AppContextMenuItem
            label="Logout"
            :href="auth.login.destroy()"
            method="post"
            :icon="IconLogout2"
          />
        </AppContextMenu>
      </li>
    </ul>
  </nav>
</template>

<script setup lang="ts">
import { aboutUs, home } from '@/routes';
import account from '@/routes/account';
import auth from '@/routes/auth';
import contact from '@/routes/contact';
import { Form } from '@inertiajs/vue3';
import { IconHeart, IconLogin2, IconLogout2, IconSearch, IconShoppingBag, IconShoppingCart, IconUser } from '@tabler/icons-vue';
import AppContextMenu from './AppContextMenu.vue';
import AppContextMenuItem from './AppContextMenuItem.vue';
import AppInput from './AppInput.vue';
import AppLogo from './AppLogo.vue';
import NavLink from './NavLink.vue';
</script>
