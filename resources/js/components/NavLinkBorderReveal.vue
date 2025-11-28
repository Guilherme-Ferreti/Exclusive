<template>
  <li>
    <BaseLink
      class="btn-border-reveal h-full w-full cursor-pointer border-b border-gray-300 bg-white p-1 -outline-offset-2"
      :href="href"
      :title="label"
      :method="method"
      :as="as"
    >
      <AppIcon
        :icon="icon"
        class="mr-1"
      />
      <span>{{ label }}</span>
    </BaseLink>
  </li>
</template>

<script lang="ts">
interface Props {
  href: InertiaLinkProps['href'];
  label: string;
  icon: Icon;
  method?: InertiaLinkProps['method'];
  as?: InertiaLinkProps['as'];
}
</script>

<script setup lang="ts">
import { InertiaLinkProps } from '@inertiajs/vue3';
import { type Icon } from '@tabler/icons-vue';
import AppIcon from './AppIcon.vue';
import BaseLink from './BaseLink.vue';

withDefaults(defineProps<Props>(), {
  method: 'get',
  as: undefined,
});
</script>
