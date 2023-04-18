<template>
    <div class="border relative flex min-h-screen bg-dark-slate-grey">
        <div class="flex-none flex flex-col py-8 items-center w-20 font-bold text-comet border-tuna border-r">
           <Navigation />
        </div>
        <div class="text-white px-8 pt-5 w-full">
            <Header />
            <slot></slot>
        </div>
    </div>
</template>
<script setup>
import Navigation from '@/Shared/Navigation.vue'
import Header from '@/Shared/Header.vue'
</script>
