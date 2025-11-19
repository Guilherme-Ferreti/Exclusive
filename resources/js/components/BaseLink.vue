<template>
    <Link
        :href="href"
        :aria-current="isActive ? 'page' : undefined"
    >
        <slot />
    </Link>
</template>

<script setup lang="ts">
import { getBasePath } from '@/helpers/utils';
import { InertiaLinkProps, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<InertiaLinkProps>();

const page = usePage();

const isActive = computed(() => {
    const propHref = typeof props.href === 'string' ? props.href : props.href?.url || '';

    return getBasePath(page.url) === getBasePath(propHref);
});
</script>
