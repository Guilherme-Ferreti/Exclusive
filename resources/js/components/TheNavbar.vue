<template>
    <nav class="flex w-full items-center justify-between gap-2">
        <span class="text-2xl font-bold">Exclusive</span>
        <ul class="flex items-center justify-between gap-3">
            <li>
                <Link :href="home()">Home</Link>
            </li>
            <li>
                <Link href="/">Contact</Link>
            </li>
            <li>
                <Link href="/">About</Link>
            </li>
            <li>
                <Link :href="signUp.create()">Sign Up</Link>
            </li>
        </ul>
        <ul class="flex items-center gap-1">
            <li class="mr-2">
                <input type="text" placeholder="What are you looking for?" />
            </li>
            <li>
                <Link href="/">
                    <IconHeart size="2rem" stroke="1.5" />
                </Link>
            </li>
            <li>
                <Link href="/">
                    <IconShoppingCart size="2rem" stroke="1.5" />
                </Link>
            </li>
            <li>
                <Link :href="login.create()">
                    <IconUser size="2rem" stroke="1.5" />
                </Link>
            </li>
        </ul>
    </nav>
</template>

<script setup lang="ts">
import { home } from '@/routes';
import login from '@/routes/auth/login';
import signUp from '@/routes/auth/sign-up';
import { Link } from '@inertiajs/vue3';
import { IconHeart, IconShoppingCart, IconUser } from '@tabler/icons-vue';
</script>
