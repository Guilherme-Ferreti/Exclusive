<template>
  <component
    :is="href ? BaseLink : 'button'"
    :href="href"
    :type="type"
    class="cursor-pointer"
  >
    <AppIcon :icon="icon" />
  </component>
</template>
<script lang="ts">
interface AppIconButtonProps {
  type?: HTMLButtonElement['type'];
  href?: InertiaLinkProps['href'];
  icon: Icon;
}
</script>

<script setup lang="ts">
import { InertiaLinkProps } from '@inertiajs/vue3';
import { type Icon } from '@tabler/icons-vue';
import AppIcon from './AppIcon.vue';
import BaseLink from './BaseLink.vue';

withDefaults(defineProps<AppIconButtonProps>(), {
  type: 'button',
});
</script>
