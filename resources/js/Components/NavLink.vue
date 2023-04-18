<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? "before:content-[''] h-10 leading-[2.5] before:w-1 before:absolute before:left-0 before:rounded-br-lg before:rounded-tr-lg relative before:h-full before:bg-mint text-mint"
    : 'h-10 leading-[2.5]'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
