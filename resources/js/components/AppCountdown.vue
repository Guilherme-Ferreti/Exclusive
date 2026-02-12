<template>
  <div class="app-countdown">
    <div class="app-countdown__unit-group">
      <div class="app-countdown__unit">
        <span class="app-countdown__label">Days</span>
        <span class="app-countdown__value">{{ days }}</span>
      </div>
      <span class="app-countdown__colon">:</span>
      <div class="app-countdown__unit">
        <span class="app-countdown__label">Hours</span>
        <span class="app-countdown__value">{{ hours }}</span>
      </div>
    </div>
    <span class="app-countdown__colon | hidden min-[31rem]:block">:</span>
    <div class="app-countdown__unit-group">
      <div class="app-countdown__unit">
        <span class="app-countdown__label">Minutes</span>
        <span class="app-countdown__value">{{ minutes }}</span>
      </div>
      <span class="app-countdown__colon">:</span>
      <div class="app-countdown__unit">
        <span class="app-countdown__label">Seconds</span>
        <span class="app-countdown__value">{{ seconds }}</span>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed, onMounted, onUnmounted, ref, watch } from 'vue';

const props = defineProps<{
  targetTime: string | Date;
}>();

const remainingTime = ref<number>(0);

let timer: ReturnType<typeof setInterval> | null = null;

onMounted(() => {
  updateRemainingTime();

  timer = setInterval(updateRemainingTime, 1000);
});

onUnmounted(() => {
  if (timer) {
    clearInterval(timer);
  }
});

watch(
  () => props.targetTime,
  () => updateRemainingTime(),
);

const updateRemainingTime = () => {
  const target = new Date(props.targetTime).getTime();
  const now = Date.now();

  remainingTime.value = Math.max(0, target - now);

  if (remainingTime.value === 0 && timer) {
    clearInterval(timer);
    timer = null;
  }
};

const pad = (value: number) => value.toString().padStart(2, '0');

const days = computed(() => pad(Math.floor(remainingTime.value / (1000 * 60 * 60 * 24))));
const hours = computed(() => pad(Math.floor((remainingTime.value / (1000 * 60 * 60)) % 24)));
const minutes = computed(() => pad(Math.floor((remainingTime.value / (1000 * 60)) % 60)));
const seconds = computed(() => pad(Math.floor((remainingTime.value / 1000) % 60)));
</script>

<style scoped>
@reference 'tailwindcss';

.app-countdown {
  @apply flex flex-wrap items-center;
}

.app-countdown__unit-group {
  @apply flex items-center justify-between;
}

.app-countdown__unit {
  @apply grid w-[7ch] text-center;
}

.app-countdown__label {
  @apply font-medium;
}

.app-countdown__value {
  @apply text-[2rem] leading-none font-semibold;
}

.app-countdown__colon {
  @apply translate-y-0.5 text-[2rem] text-red-300;
}
</style>
