<template>
    <nav
        class="hidden w-full items-center justify-between gap-2 lg:flex"
        aria-label="Main navigation"
    >
        <span class="text-2xl font-bold">Exclusive</span>
        <ul class="flex items-center justify-between gap-3">
            <NavbarLink
                :href="home()"
                label="Home"
            />
            <NavbarLink
                :href="home()"
                label="About"
            />
            <NavbarLink
                :href="home()"
                label="Contact"
            />
            <NavbarLink
                :href="signUp.create()"
                label="Sign Up"
            />
        </ul>
        <ul class="flex items-center gap-1">
            <li class="mr-2">
                <input
                    type="text"
                    placeholder="What are you looking for?"
                />
            </li>
            <NavbarLink
                label="Wishlist"
                :icon="IconHeart"
                :href="home()"
            />
            <NavbarLink
                label="Cart"
                :icon="IconShoppingCart"
                :href="home()"
            />
            <NavbarLink
                label="My Account"
                :icon="IconUser"
                :href="home()"
            />
        </ul>
    </nav>
</template>

<script setup lang="ts">
import { home } from '@/routes';
import signUp from '@/routes/auth/sign-up';
import { IconHeart, IconShoppingCart, IconUser } from '@tabler/icons-vue';
import NavbarLink from './NavbarLink.vue';
</script>
