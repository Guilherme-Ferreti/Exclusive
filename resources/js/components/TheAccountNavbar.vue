<template>
  <nav>
    <ul
      v-for="section in sections"
      :key="section.title"
      class="not-first:mt-1"
    >
      <h3 class="font-medium">{{ section.title }}</h3>
      <li
        v-for="link in section.links"
        :key="link.title"
        class="ml-2 text-gray-500 not-first:mt-0.5"
      >
        <BaseLink
          :title="link.title"
          :href="link.href"
          active-classes="text-red-500"
          >{{ link.title }}</BaseLink
        >
      </li>
    </ul>
  </nav>
</template>

<script setup lang="ts">
import account from '@/routes/account';
import BaseLink from './BaseLink.vue';

const sections = [
  {
    title: 'Manage My Account',
    links: [
      {
        title: 'My Profile',
        href: account.profile.edit(),
      },
    ],
  },
  {
    title: 'My Orders',
    links: [
      {
        title: 'All Orders',
        href: account.orders.index(),
      },
      {
        title: 'My Wishlist',
        href: account.wishlist(),
      },
    ],
  },
];
</script>
