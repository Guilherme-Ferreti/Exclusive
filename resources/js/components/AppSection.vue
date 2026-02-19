<template>
  <section class="flex w-full flex-col gap-y-1.5">
    <div class="flex w-full flex-col gap-y-1.5">
      <slot />
    </div>
    <div class="flex w-full flex-wrap gap-1.5">
      <slot name="footer" />
    </div>
    <hr class="mt-1.5 w-full border-b border-gray-300" />
  </section>
</template>
