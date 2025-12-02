<template>
  <footer class="app-container | w-full bg-black text-white">
    <div class="grid place-content-center gap-3.75 pt-3.75 pb-3.25 sm:grid-cols-2 lg:flex lg:flex-wrap lg:justify-between">
      <div class="footer__column">
        <div class="mb-1.5">
          <AppLogo />
        </div>
        <h3>Subscribe</h3>
        <p class="mb-1.5">Get 10% off your first order</p>
        <AppInput
          placeholder="Enter your email"
          :icon="IconSend2"
          name="newsletter-email"
          type="email"
          variant="underline"
        />
      </div>
      <div class="footer__column">
        <h3>Support</h3>
        <ul aria-label="Our contact information">
          <li>111 Bijoy sarani, Dhaka, DH 1515, Bangladesh.</li>
          <li>exclusive@gmail.com</li>
          <li>+88015-88888-9999</li>
        </ul>
      </div>
      <div class="footer__column">
        <h3>Account</h3>
        <ul>
          <li><BaseLink :href="account.profile.edit()">My Account</BaseLink></li>
          <li><BaseLink :href="auth.login.create()">Login / Register</BaseLink></li>
          <li><BaseLink :href="account.cart()">Cart</BaseLink></li>
          <li><BaseLink :href="account.wishlist()">Wishlist</BaseLink></li>
          <li><BaseLink :href="home()">Shop</BaseLink></li>
        </ul>
      </div>
      <div class="footer__column">
        <h3>Quick Link</h3>
        <ul>
          <li><BaseLink :href="contact.create()">Contact</BaseLink></li>
        </ul>
      </div>
    </div>
    <div class="full-width | border-t border-gray-500 p-1 text-center text-gray-500">
      <p>&copy; Copyright Rimel 2022. All right reserved.</p>
    </div>
  </footer>
</template>

<script setup lang="ts">
import { home } from '@/routes';
import account from '@/routes/account';
import auth from '@/routes/auth';
import contact from '@/routes/contact';
import { IconSend2 } from '@tabler/icons-vue';
import AppInput from './AppInput.vue';
import AppLogo from './AppLogo.vue';
import BaseLink from './BaseLink.vue';
</script>

<style scoped>
@reference 'tailwindcss';

.footer__column {
  @apply max-w-15;
}
.footer__column h3 {
  @apply mb-1.5 text-xl font-medium;
}

.footer__column ul {
  @apply space-y-1;
}

.footer__column li a:hover {
  @apply text-gray-500;
}
</style>
