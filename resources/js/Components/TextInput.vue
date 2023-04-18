<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>
    <input class="w-full
            text-comet
            focus:border-comet
            focus:ring-0
            mt-2
            bg-tuna
            border-2
            border-bright-gray
            rounded-md
            placeholder:text-sm"
        :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>
