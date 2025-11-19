<template>
    <div class="space-y-5">
        <header class="app-container | border-b border-gray-300 pt-3 pb-1">
            <TheNavbar />
        </header>
        <main class="app-container">
            <slot />
        </main>
    </div>
</template>

<script setup lang="ts">
import TheNavbar from '@/components/TheNavbar.vue';
</script>
