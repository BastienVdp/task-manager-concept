<template>
    <Link :href="route('tasks.create')" class="group flex items-center bg-bright-gray hover:bg-[#31354C] rounded-full p-1">
        <span class="mx-2 text-sm text-ghost-white">Nouvelle tâche</span>
        <span class="group-hover:scale-125 transition-transform ease-in-out ml-1 w-8 h-8 flex items-center justify-center border-comet border-2 text-comet rounded-full text-sm">
            <i class="fa-solid fa-plus"></i>
        </span>
    </Link>
</template>
<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>
