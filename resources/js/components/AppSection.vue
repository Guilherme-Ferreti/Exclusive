<template>
  <section class="space-y-1.5">
    <div class="space-y-1.5">
      <slot />
    </div>
    <div
      v-if="$slots.footer"
      class="flex w-full flex-wrap gap-1.5"
    >
      <slot name="footer" />
    </div>
    <hr class="mt-3 w-full text-gray-300" />
  </section>
</template>
