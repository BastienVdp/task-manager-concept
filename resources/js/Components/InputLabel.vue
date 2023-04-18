<script setup>
defineProps(['value']);
</script>

<template>
    <label class="block font-semibold text-sm bg-tuna absolute left-4 px-2 text-gray">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
