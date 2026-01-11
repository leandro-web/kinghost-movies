<script setup lang="ts">
import { computed } from "vue";

const props = defineProps({
  variant: {
    type: String,
    default: "primary",
    validator: (value) => ["primary", "danger", "disabled"].includes(value),
  },
  disabled: Boolean,
});

const baseClasses =
  "w-full py-2 rounded-lg font-medium transition flex intems-center justify-center gap-2 mt-auto text-white";

const variantClasses = computed(() => {
  if (props.disabled) return "bg-gray-400 cursor-not-allowed";

  switch (props.variant) {
    case "danger":
      return "bg-red-500 text-white hover:bg-red-600 shadow-sm";
    case "primary":
    default:
      return "bg-green-500 hover:bg-green-600";
  }
});
</script>

<template>
  <button :class="[baseClasses, variantClasses]" :disabled="disabled">
    <slot />
  </button>
</template>
