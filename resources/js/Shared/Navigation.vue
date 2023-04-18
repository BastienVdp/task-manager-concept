<template>
    <div class="mb-8 w-10 h-10 rounded-full flex items-center justify-center border-cold-purple bg-purple-haze text-cold-purple">
        <i class="fa-brands fa-pied-piper"></i>
    </div>
    <ul role="list" class="flex flex-col gap-6 w-full text-center ">
        <NavLink :href="route('dashboard.index')" :active="$page.component === 'Dashboard'">
            <i class="align-baseline fa-solid fa-house"></i>
        </NavLink>
        <NavLink :href="route('tasks.index')" :active="$page.component.startsWith('Tasks')">
            <i class="fa-solid fa-list-check"></i>
        </NavLink>
        <NavLink href="#" :active="false">
            <i class="fa-solid fa-user"></i>
        </NavLink>
    </ul>
</template>
<script setup>
import NavLink from "@/Components/NavLink.vue";

</script>
