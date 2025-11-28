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
        :href="auth.signUp.create()"
        label="Sign Up"
        class="mr-2"
      />
      <li class="mr-2 ml-auto">
        <AppInput
          type="search"
          placeholder="What are you looking for?"
          name="search"
          class="min-w-16 text-sm"
          :icon="IconSearch"
          autocomplete="search"
        />
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
      <NavLink
        v-if="$page.props.auth.isAuthenticated"
        label="My Account"
        :icon="IconUser"
        :href="account.profile.edit()"
      />
    </ul>
  </nav>
</template>

<script setup lang="ts">
import { aboutUs, home } from '@/routes';
import account from '@/routes/account';
import auth from '@/routes/auth';
import contact from '@/routes/contact';
import { IconHeart, IconLogin2, IconSearch, IconShoppingCart, IconUser } from '@tabler/icons-vue';
import AppInput from './AppInput.vue';
import AppLogo from './AppLogo.vue';
import NavLink from './NavLink.vue';
</script>
