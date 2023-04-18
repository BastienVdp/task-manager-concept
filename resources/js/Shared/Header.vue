<template>
    <header class="flex justify-between items-center mb-8">
        <div class="relative h-1.5 opacity-20">
            <span class="block h-0.5 w-7 bg-gray absolute"></span>
            <span class="block h-0.5 w-4 mt-1.5 bg-gray absolute"></span>
            <span class="block h-0.5 w-2 mt-3 bg-gray  absolute"></span>
        </div>
        <div class="flex basis-1/2 justify-between">
            <div class="flex items-center">
                <i class="fa-solid fa-magnifying-glass text-lg text-comet mr-1"></i>
                <input type="text" class="focus:ring-0 bg-dark-slate-grey border-none text-comet placeholder:text-sm text-sm" placeholder="Rechercher une tâche">
            </div>
            <div class="text-comet"> <i class="fa-solid fa-user"></i></div>
        </div>
    </header>
</template>

<script setup>
</script>
