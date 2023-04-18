<template>
    <Head title="Dashboard" />

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-ghost-white">
            Mes tâches
        </h1>
        <AddTask />
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div class="bg-tuna rounded-lg p-4">
            <h2 class="text-lg font-semibold text-ghost-white mb-3">En attente</h2>
            <template v-for="task in todo" :key="task.id">
                <Link :href="route('tasks.show', task.id)">
                    <div class="bg-bright-gray rounded-lg p-3.5 mb-3.5">
                        <div class="flex justify-between items-center text-gray">
                            <div>
                                <div class="flex gap-2 items-center mb-2">
                                    <i class="fa-solid fa-star text-sm" :class="{
                                        'text-golden' : task.liked == 1,
                                        'text-iris' : task.liked == 0}"></i>
                                    <h3 class="text-md font-semibold text-ghost-white">{{ task.title }}</h3>
                                </div>
                                <div>
                                    <div class="flex items-center">
                                        <div class="text-sm flex items-center">
                                            <i class="fa-solid fa-fire text-xs mr-2"></i>
                                            Priorité
                                        </div>
                                        <span :class="{
                                            'text-golden' : task.priority == 'High',
                                            'text-iris' : task.priority == 'Normal',
                                            'text-gray-light' : task.priority == 'Low'
                                            }"
                                                class="ml-2  text-sm">
                                            {{ task.priority == 'High' ? '&Eacute;levé' : task.priority == 'Low' ? 'Faible' : task.priority }}
                                        </span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="text-sm flex items-center">
                                            <i class="fa-solid fa-clock text-xs mr-2"></i>
                                            Deadline
                                        </div>
                                        <div
                                            class="ml-2 text-gray text-sm">
                                            {{ deadline(task.deadline) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center font-bold">
                                <span class="text-xl text-ghost-white mr-1.5">{{ task.todos_completed_count }}</span>
                                /
                                <span class="text-xl text-ghost-white ml-1.5">{{ task.todos_count }}</span>
                                <i class="fa-solid fa-list-check ml-2.5"></i>
                            </div>
                        </div>
                    </div>
                </Link>
            </template>
        </div>
        <div class="bg-tuna rounded-lg p-3.5">
            <h2 class="text-lg font-semibold text-ghost-white mb-3">En cours</h2>
            <template v-for="task in doing" :key="task.id">
                <Link :href="route('tasks.show', task.id)">
                    <div class="bg-bright-gray rounded-lg p-3.5 mb-3.5">
                        <div class="flex justify-between items-center text-gray">
                            <div>
                                <div class="flex gap-2 items-center mb-2">
                                    <i class="fa-solid fa-star text-sm" :class="{
                                        'text-golden' : task.liked == 1,
                                        'text-iris' : task.liked == 0}"></i>
                                    <h3 class="text-md font-semibold text-ghost-white">{{ task.title }}</h3>
                                </div>
                                <div>
                                    <div class="flex items-center">
                                        <div class="text-sm flex items-center">
                                            <i class="fa-solid fa-fire text-xs mr-2"></i>
                                            Priorité
                                        </div>
                                        <span :class="{
                                            'text-golden' : task.priority == 'High',
                                            'text-iris' : task.priority == 'Normal',
                                            'text-gray-light' : task.priority == 'Low'
                                            }"
                                                class="ml-2  text-sm">
                                            {{ task.priority == 'High' ? '&Eacute;levé' : task.priority == 'Low' ? 'Faible' : task.priority }}
                                        </span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="text-sm flex items-center">
                                            <i class="fa-solid fa-clock text-xs mr-2"></i>
                                            Deadline
                                        </div>
                                        <div
                                            class="ml-2 text-gray text-sm">
                                            {{ deadline(task.deadline) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center font-bold">
                                <span class="text-xl text-ghost-white mr-1.5">{{ task.todos_completed_count }}</span>
                                /
                                <span class="text-xl text-ghost-white ml-1.5">{{ task.todos_count }}</span>
                                <i class="fa-solid fa-list-check ml-2.5"></i>
                            </div>
                        </div>
                    </div>
                </Link>
            </template>
        </div>
        <div class="bg-tuna rounded-lg p-3.5">
            <h2 class="text-lg font-semibold text-ghost-white mb-3">Complétées</h2>
            <template v-for="task in done" :key="task.id">
                <Link :href="route('tasks.show', task.id)">
                    <div class="bg-bright-gray rounded-lg p-3.5 mb-3.5">
                        <div class="flex justify-between items-center text-gray">
                            <div>
                                <div class="flex gap-2 items-center mb-2">
                                    <i class="fa-solid fa-star text-sm" :class="{
                                        'text-golden' : task.liked == 1,
                                        'text-iris' : task.liked == 0}"></i>
                                    <h3 class="text-md font-semibold text-ghost-white">{{ task.title }}</h3>
                                </div>
                                <div>
                                    <div class="flex items-center">
                                        <div class="text-sm flex items-center">
                                            <i class="fa-solid fa-fire text-xs mr-2"></i>
                                            Priorité
                                        </div>
                                        <span :class="{
                                            'text-golden' : task.priority == 'High',
                                            'text-iris' : task.priority == 'Normal',
                                            'text-gray-light' : task.priority == 'Low'
                                            }"
                                                class="ml-2  text-sm">
                                            {{ task.priority == 'High' ? '&Eacute;levé' : task.priority == 'Low' ? 'Faible' : task.priority }}
                                        </span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="text-sm flex items-center">
                                            <i class="fa-solid fa-clock text-xs mr-2"></i>
                                            Deadline
                                        </div>
                                        <div
                                            class="ml-2 text-gray text-sm">
                                            {{ deadline(task.deadline) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center font-bold">
                                <span class="text-xl text-ghost-white mr-1.5">{{ task.todos_completed_count }}</span>
                                /
                                <span class="text-xl text-ghost-white ml-1.5">{{ task.todos_count }}</span>
                                <i class="fa-solid fa-list-check ml-2.5"></i>
                            </div>
                        </div>
                    </div>
                </Link>
            </template>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3'
import AddTask from '@/Components/AddTask.vue';
import { replaceDate } from '@/Utils/utils.js'

const props = defineProps({
    status: Object,
    todos: Object,
    todo: Object,
    doing: Object,
    done: Object,
})

const deadline = (dateString) => {
    let today = new Date()
    let date = new Date(dateString)
    return replaceDate(today) == replaceDate(date) ? "Aujourd'hui" : 'dans ' + (Math.round((date.getTime() - today.getTime()) / (1000 * 3600 * 24)) + 1 ) + ' jours'
}

</script>

