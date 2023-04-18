<template>
    <Head title="Dashboard" />
    <div class="flex gap-4 mb-8">
        <div class="w-full bg-tuna p-7 rounded-lg">
            <div class="flex gap-8">
                <div class="w-36 p-3">
                    <img
                        src="https://via.placeholder.com/150"
                        alt=""
                        class="rounded-full max-w-full w-full"/>
                </div>
                <div class="flex flex-col mb-2">
                    <h1 class="text-2xl font-semibold text-ghost-white">{{ $page.props.auth.user.name }}</h1>
                    <p class="text-sm font-semibold text-comet mt-3 mb-auto">
                        Hello ! Tu as <b>{{ taskCount }}</b> nouvelle{{ taskCount > 1 ? 's' : '' }} tâche{{ taskCount > 1 ? 's' : '' }} aujourd'hui.
                    </p>
                    <div class="flex gap-4">
                        <div class="flex items-center bg-bright-gray rounded-full p-1.5">
                            <div class="w-8 h-8 flex items-center justify-center bg-purple-haze text-cold-purple rounded-full text-sm">
                                <i class="fa-solid fa-award"></i>
                            </div>
                            <div class="ml-3 mr-2 font-bold text-ghost-white">
                                {{ completedCount }}
                            </div>
                        </div>
                        <div class="flex items-center bg-bright-gray rounded-full p-1.5">
                            <div class="w-8 h-8 flex items-center justify-center bg-dirt-brown text-golden rounded-full text-sm">
                                <i class="fa-solid fa-fire"></i>
                            </div>
                            <div class="ml-3 mr-2 font-bold text-ghost-white">
                                {{ importantCount }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-tuna flex-none basis-1/3 rounded-lg p-4">
            <h2 class="text-lg font-semibold text-ghost-white">Activité</h2>
        </div>
    </div>
    <Category :tasksCount="taskCount" :importantCount="importantCount" :categories="filters" />
    <div class="flex justify-between items-center">
        <h2 class="text-lg font-semibold text-ghost-white px-14">
            Aujourd'hui
            <span class="text-xs text-white font-bold ml-2 bg-bright-gray p-1 px-1.5 rounded-full">
                {{ tasks.length }}
            </span>
        </h2>
        <span class="text-sm text-ghost-white">{{ replaceDate(date) }}</span>
    </div>
    <Link :href="route('tasks.show', task.id)" v-for="task in tasks" :key="task.id" class="flex bg-tuna my-4 py-3.5 px-14 rounded-lg text-comet">
        <div class="flex items-center gap-4 basis-1/2">
            <i class="fa-regular fa-circle-check text-xl" :class="{ 'text-mint': task.state == status.COMPLETED }"></i>
            <span class="text-gray">
                {{ task.title }}
            </span>
        </div>
        <div class="flex items-center justify-end gap-4 basis-1/2 text-sm">
            <div class="w-44">
                <span><i class="fa-solid fa-fire mx-3"></i>Priorité</span>
                <span class="ml-5 text-golden">
                    {{ task.priority == 'High' ? '&Eacute;levé' : task.priority == 'Low' ? 'Faible' : task.priority }}
                </span>
            </div>
            <div class="w-52">
                <span><i class="fa-solid fa-calendar-days mx-3"></i>Date</span>
                <span class="ml-5 text-gray">Aujourd'hui</span>
            </div>
            <div :class="{
                    'bg-bright-gray' : task.state == status.WAITING,
                    'text-comet' : task.state == status.WAITING,
                    'bg-purple-haze' : task.state == status.PROCESSING,
                    'text-cold-purple' : task.state == status.PROCESSING,
                    'bg-dark-mint' : task.state == status.COMPLETED,
                    'text-green' : task.state == status.COMPLETED,
                }"
                class="w-24 text-center px-3 py-2 font-bold rounded-full">
                {{ task.state }}
            </div>
        </div>
    </Link>
    <div v-if="tasks.length == 0"
        class="bg-tuna my-4 py-3.5 text-center rounded-lg text-comet">
        Pas de tâche
    </div>
    <div class="flex items-center">
        <h2 class="mt-4 text-lg font-semibold text-ghost-white px-14">
            &Agrave; venir
            <span class="text-xs text-white font-bold ml-2 bg-bright-gray p-1 px-1.5 rounded-full">
                {{ up_coming.length }}
            </span>
        </h2>
    </div>
    <div v-for="task in up_coming" :key="task.id" class="flex bg-tuna my-4 py-3.5 px-14 rounded-lg text-comet">
        <div class="flex items-center gap-4 basis-1/2">
            <i class="fa-regular fa-circle-check text-xl"></i>
            <span class="text-gray">
                {{ task.title }}
            </span>
        </div>
        <div class="flex items-center justify-end gap-4 basis-1/2 text-sm">
            <div class="w-44">
                <span><i class="fa-solid fa-fire mx-3"></i>Priorité</span>
                <span class="ml-5 text-golden">
                    {{ task.priority == 'High' ? '&Eacute;levé' : task.priority == 'Low' ? 'Faible' : task.priority }}
                </span>
            </div>
            <div class="w-52">
                <span><i class="fa-solid fa-calendar-days mx-3"></i>Date</span>
                <span class="ml-5 text-gray">{{ replaceDate(task.deadline) }}</span>
            </div>
            <div :class="{
                    'bg-bright-gray' : task.state == status.WAITING,
                    'text-comet' : task.state == status.WAITING,
                    'bg-purple-haze' : task.state == status.PROCESSING,
                    'text-cold-purple' : task.state == status.PROCESSING,
                    'bg-dark-mint' : task.state == status.COMPLETED,
                    'text-green' : task.state == status.COMPLETED,
                }"
                class="w-24 text-center px-3 py-2 font-bold rounded-full">
                {{ task.state }}
            </div>
        </div>
    </div>
    <div v-if="up_coming.length == 0"
        class="bg-tuna my-4 py-3.5 text-center rounded-lg text-comet">
        Pas de tâche
    </div>
</template>

<script setup>
import Category from '@/Components/Category.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { replaceDate } from '@/Utils/utils.js'

const props = defineProps({
    completedCount: Number,
    taskCount: Number,
    importantCount: Number,
    tasks: Object,
    up_coming: Object,
    status: Object,
    filters: Array,
})

const date = new Date();

</script>
