<template>
  <div class="space-y-2">
    <AppSection aria-label="About our company">
      <AppSectionBadge
        text="About Us"
        class="mb-2.5"
      />
      <h1 class="app-heading">Our Story</h1>
      <p>
        Founded in 2020, we started with a simple mission: to provide high-quality products that enhance everyday life. What began as a small
        operation has grown into a trusted destination for customers seeking premium goods and exceptional service.
      </p>
      <p>
        Our journey reflects our commitment to quality, innovation, and customer satisfaction. We believe in curating products that balance quality,
        functionality, and timeless design.
      </p>
      <p>
        Today, we continue to innovate and expand our collection, staying true to our founding principles while embracing new technologies and trends
        that benefit our customers.
      </p>
      <p>Thank you for being part of our story. We look forward to serving you for years to come.</p>
    </AppSection>
    <hr class="app-divider" />
    <AppSection aria-label="Company timeline">
      <h2 class="app-heading">Our History</h2>
      <div class="space-y-2">
        <div
          v-for="milestone in milestones"
          :key="milestone.year"
          class="flex gap-2 md:gap-3"
        >
          <div class="shrink-0 text-base font-bold text-black md:text-base">
            {{ milestone.year }}
          </div>
          <div>
            <h3 class="about-us__heading mb-0.5">
              {{ milestone.title }}
            </h3>
            <p>
              {{ milestone.description }}
            </p>
          </div>
        </div>
      </div>
    </AppSection>
    <hr class="app-divider" />
    <AppSection aria-label="Our mission and values">
      <h2 class="app-heading">Our Mission & Values</h2>
      <div class="grid gap-3 md:grid-cols-2 md:gap-4">
        <div>
          <h3 class="about-us__heading mb-1">Mission</h3>
          <p>
            To provide exceptional products that enrich our customers' lives while maintaining our commitment to quality, sustainability, and
            outstanding service. We strive to create lasting value for our customers, team, and community.
          </p>
        </div>
        <div>
          <h3 class="about-us__heading mb-1">Core Values</h3>
          <ul class="space-y-1.5">
            <li
              v-for="value in values"
              :key="value.title"
              class="flex gap-1.5"
            >
              <span class="shrink-0 font-semibold text-black">{{ value.icon }}</span>
              <div>
                <span class="font-semibold text-black">{{ value.title }}</span>
                <p>{{ value.description }}</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </AppSection>
    <hr class="app-divider" />
    <AppSection aria-label="Company statistics">
      <div class="flex flex-wrap items-center justify-center gap-2 text-center">
        <div
          v-for="stat in stats"
          :key="stat.label"
          class="w-full max-w-13.5 rounded-lg bg-gray-300 p-1"
        >
          <div class="text-2xl font-bold text-black">
            {{ stat.value }}
          </div>
          <div>
            {{ stat.label }}
          </div>
        </div>
      </div>
    </AppSection>
  </div>
</template>

<script setup lang="ts">
import AppSection from '@/components/AppSection.vue';
import AppSectionBadge from '@/components/AppSectionBadge.vue';

const milestones = [
  {
    year: '2020',
    title: 'Founded',
    description: 'Started as a small team with a vision to provide quality products.',
  },
  {
    year: '2021',
    title: 'First Milestone',
    description: 'Reached 10,000 customers and expanded our product line.',
  },
  {
    year: '2023',
    title: 'Growth Phase',
    description: 'Opened additional fulfillment centers to serve more customers.',
  },
  {
    year: '2025',
    title: 'Present Day',
    description: 'Serving customers nationwide with an ever-growing catalog.',
  },
];

const values = [
  {
    icon: '✓',
    title: 'Quality First',
    description: 'We never compromise on the quality of our products.',
  },
  {
    icon: '✓',
    title: 'Customer Focus',
    description: 'Our customers are at the heart of everything we do.',
  },
  {
    icon: '✓',
    title: 'Integrity',
    description: 'We build trust through transparency and honest relationships.',
  },
  {
    icon: '✓',
    title: 'Innovation',
    description: 'We continuously improve to better serve our customers.',
  },
];

const stats = [
  {
    value: '5+',
    label: 'Years in Business',
  },
  {
    value: '50K+',
    label: 'Happy Customers',
  },
  {
    value: '1000+',
    label: 'Products',
  },
  {
    value: '4.9',
    label: 'Average Rating',
  },
];
</script>

<style scoped>
@reference 'tailwindcss';

.about-us__heading {
  @apply text-lg font-semibold text-black;
}
</style>
