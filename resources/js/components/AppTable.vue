<template>
  <div class="relative w-full overflow-auto">
    <table class="app-table">
      <thead v-if="$slots.header">
        <tr class="app-table__header">
          <slot name="header" />
        </tr>
      </thead>
      <tbody>
        <slot />
      </tbody>
    </table>
  </div>
</template>

<script setup lang="ts"></script>

<style scoped>
@reference 'tailwindcss';

.app-table {
  @apply w-full table-auto border-collapse overflow-scroll text-left;
}

.app-table__header {
  @apply border-gray-200 bg-gray-50 border-b;
}

.app-table :deep(th),
.app-table :deep(td) {
  @apply px-1.5 py-1 text-left text-sm;
}

.app-table :deep(th) {
  @apply font-semibold text-gray-700;
}

.app-table :deep(td) {
  @apply text-gray-600 border-b border-gray-100;
}

.app-table :deep(tr:hover td) {
  @apply bg-gray-50;
}
</style>
