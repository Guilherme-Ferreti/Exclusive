<template>
  <section
    :class="{
      'space-y-1.5': $slots.footer,
    }"
  >
    <div class="space-y-1.5">
      <slot />
    </div>
    <div
      v-if="$slots.footer"
      class="flex w-full flex-wrap gap-1.5"
    >
      <slot name="footer" />
    </div>
  </section>
</template>
