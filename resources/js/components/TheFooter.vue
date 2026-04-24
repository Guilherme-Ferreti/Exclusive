<template>
  <footer class="app-container | w-full bg-black text-white">
    <div class="grid gap-2.5 pt-2.5 pb-2 sm:grid-cols-2 md:pt-3 md:pb-3.25 lg:flex lg:flex-wrap lg:justify-between">
      <div class="footer-column space-y-1.5">
        <div>
          <AppLogo />
        </div>
        <h3>Subscribe</h3>
        <p>Get 10% off your first order</p>
        <Form class="max-w-15">
          <AppInput
            placeholder="Enter your email"
            name="newsletter-email"
            type="email"
            variant="underline"
            :icon-right="IconSend2"
            icon-right-type="submit"
            icon-right-title="Subscribe"
          />
        </Form>
      </div>
      <div class="footer-column">
        <h3>Support</h3>
        <ul aria-label="Our contact information">
          <li>111 Bijoy sarani, Dhaka, DH 1515, Bangladesh.</li>
          <li>exclusive@gmail.com</li>
          <li>+88015-88888-9999</li>
        </ul>
      </div>
      <div class="footer-column">
        <h3>Account</h3>
        <ul>
          <li><BaseLink :href="route('account.profile.edit')">My Account</BaseLink></li>
          <li><BaseLink :href="route('auth.login.create')">Login / Register</BaseLink></li>
          <li><BaseLink :href="route('cart.show')">Cart</BaseLink></li>
          <li><BaseLink :href="route('account.wishlist')">Wishlist</BaseLink></li>
          <li><BaseLink :href="route('home')">Shop</BaseLink></li>
        </ul>
      </div>
      <div class="footer-column">
        <h3>Quick Link</h3>
        <ul>
          <li><BaseLink :href="route('contact')">Contact</BaseLink></li>
        </ul>
      </div>
    </div>
    <div class="full-width | border-t border-gray-500 p-1 text-center text-gray-500">
      <p>&copy; Copyright {{ $page.props.name }} {{ new Date().getFullYear() }}. All right reserved.</p>
    </div>
  </footer>
</template>

<script setup lang="ts">
import { route } from '@/types/helpers/route';
import { Form } from '@inertiajs/vue3';
import { IconSend2 } from '@tabler/icons-vue';
import AppInput from './AppInput.vue';
import AppLogo from './AppLogo.vue';
import BaseLink from './BaseLink.vue';
</script>

<style scoped>
@reference 'tailwindcss';

.footer-column {
  @apply md:max-w-15;

  h3 {
    @apply mb-1.5 text-xl font-medium;
  }

  ul {
    @apply space-y-1;
  }

  li a:hover {
    @apply text-gray-500;
  }
}
</style>
