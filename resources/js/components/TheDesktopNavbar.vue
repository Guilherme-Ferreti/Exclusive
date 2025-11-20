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
        :href="signUp.create()"
        label="Sign Up"
        class="mr-2"
      />
      <li class="mr-2 ml-auto">
        <AppInput
          type="search"
          placeholder="What are you looking for?"
          name="search"
          class="min-w-16"
          :icon="IconSearch"
        />
      </li>
      <NavLink
        label="Wishlist"
        :icon="IconHeart"
        :href="home()"
        class="mr-1"
      />
      <NavLink
        label="Cart"
        :icon="IconShoppingCart"
        :href="home()"
        class="mr-1"
      />
      <NavLink
        label="My Account"
        :icon="IconUser"
        :href="home()"
      />
    </ul>
  </nav>
</template>

<script setup lang="ts">
import { aboutUs, home } from '@/routes';
import signUp from '@/routes/auth/sign-up';
import contact from '@/routes/contact';
import { IconHeart, IconSearch, IconShoppingCart, IconUser } from '@tabler/icons-vue';
import AppInput from './AppInput.vue';
import AppLogo from './AppLogo.vue';
import NavLink from './NavLink.vue';
</script>
