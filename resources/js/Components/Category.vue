<template>
    <div class="w-full flex justify-between mb-8">
        <div class="flex items-center gap-4">
            <a @click="getTasks" class="cursor-pointer py-2 px-8 rounded-full font-semibold border-tuna border-2 text-comet">
                    Toutes
                <span class="text-xs text-bright-gray ml-2 bg-comet px-1 py-0.5 rounded-full">
                    {{ tasksCount }}
                </span>
            </a>
            <a v-for="category in categories"
                @click="getTasksFiltered(category)"
                v-show="category == 'High'"
                class="cursor-pointer py-2 px-8 rounded-full font-semibold bg-tuna text-medium-purple"
                >
                {{ category == 'High' ? 'Importantes' : ''}}
                <span class="text-xs text-cold-purple ml-2 bg-medium-purple px-1 py-0.5 rounded-full">
                    {{ importantCount }}
                </span>
            </a>
        </div>
        <AddTask />
   </div>
</template>
<script setup>
import { Inertia } from '@inertiajs/inertia';

import AddTask from './AddTask.vue';

const props = defineProps({
    categories: Object,
    tasksCount: Number,
    importantCount: Number
})

const getTasksFiltered = (priority) => {
    Inertia.get(route('dashboard.filter'), {priority: priority});
}

const getTasks = () => {
    Inertia.get(route('dashboard.index'));
}
</script>
