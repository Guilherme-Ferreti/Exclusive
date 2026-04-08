<template>
  <div class="relative">
    <slot />
    <slot
      v-if="$slots.item"
      name="item"
    />
  </div>
</template>
