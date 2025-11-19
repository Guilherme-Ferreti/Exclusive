<template>
    <li class="navbar-link hover:text-gray-500">
        <BaseLink
            v-if="icon"
            :href="href"
        >
            <component
                :is="icon"
                :aria-label="label"
                size="2rem"
                stroke="1.5"
            />
        </BaseLink>
        <BaseLink
            v-else
            :href="href"
        >
            {{ label }}
        </BaseLink>
    </li>
</template>

<script setup lang="ts">
import { InertiaLinkProps } from '@inertiajs/vue3';
import { type Icon } from '@tabler/icons-vue';
import BaseLink from './BaseLink.vue';

defineProps<{
    href: InertiaLinkProps['href'];
    label: string;
    icon?: Icon;
}>();
</script>

<style scoped>
@reference 'tailwindcss';

.navbar-link:has(a[aria-current='page']):not(:has(.tabler-icon)) {
    @apply border-b;
}
</style>
