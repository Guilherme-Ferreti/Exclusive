<template>
  <li>
    <BaseLink
      class="flex cursor-pointer items-center gap-0.5 text-sm hover:text-gray-500"
      :title="label"
      :href="href"
      :method="method"
    >
      <AppIcon
        v-if="icon"
        :icon="icon"
      />
      <span>{{ label }}</span>
    </BaseLink>
  </li>
</template>

<script lang="ts">
interface Props {
  label: string;
  href: InertiaLinkProps['href'];
  icon?: Icon;
  method?: InertiaLinkProps['method'];
}
</script>

<script lang="ts" setup>
import { InertiaLinkProps } from '@inertiajs/vue3';
import { type Icon } from '@tabler/icons-vue';
import AppIcon from './AppIcon.vue';
import BaseLink from './BaseLink.vue';

withDefaults(defineProps<Props>(), {
  method: 'get',
});
</script>
