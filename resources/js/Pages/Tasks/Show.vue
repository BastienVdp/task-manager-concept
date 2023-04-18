<template>
    <Head title="Dashboard" />
        <div class="flex gap-8 justify-between items-center mb-6">
            <div>
                <div class="flex items-center mb-5">
                    <Link :href="route('tasks.index')" class="mr-5 text-2xl text-ghost-white">
                        <i class="fa-solid fa-chevron-left"></i>
                    </Link>
                    <h1 class="text-2xl font-semibold text-ghost-white mr-4">
                        <input type="text"
                        v-if="editMode"
                        v-model="form.title"
                        class="focus:border-comet p-0.5 w-44 indent-0.5 font-light text-comet border-bright-gray rounded-lg bg-tuna focus:ring-0">
                        <span v-else>{{ props.tasks[0].title }}</span>
                    </h1>
                    <div class="text-gray text-xl flex items-center gap-4">
                        <i @click="favoriteTask(props.tasks[0].id)" :class="{ 'text-golden': props.tasks[0].liked }" class="cursor-pointer fa-regular fa-star"></i>
                        <Dropdown v-if="!editMode" :todo="props.tasks[0]" :component="'task'" @edit="editTask" @delete="deleteTask" />
                        <button v-else @click="submit" class=" w-7 h-7 flex text-xs justify-center items-center text-ghost-white bg-medium-purple rounded-full relative">
                            <i class="fa-sharp fa-solid fa-check"></i>
                        </button>
                    </div>
                </div>
                <input type="text"
                        v-if="editMode"
                        v-model="form.description"
                        class="focus:border-comet p-0.5 w-44 indent-0.5 font-light text-comet border-bright-gray rounded-lg bg-tuna focus:ring-0">
                <p v-else class="font-semibold text-comet">
                    {{ props.tasks[0].description }}
                </p>
            </div>
            <div class="p-4 bg-tuna rounded-lg flex gap-6 self-start">
                <div class="flex flex-col text-ghost-white text-lg font-bold border-bright-gray border-r-2 pr-6">
                    {{ replaceDate(props.tasks[0].created_at) }}
                    <span class="text-gray text-sm font-normal uppercase">début</span>
                </div>
                <div class="flex flex-col text-ghost-white text-lg font-bold border-bright-gray border-r-2 pr-6">
                    {{ replaceDate(props.tasks[0].deadline) }}
                    <span class="text-gray text-sm font-normal uppercase">fin</span>
                </div>
                <div class="flex flex-col text-ghost-white text-lg font-bold">
                    {{ props.tasks[0].todos_count }}
                    <span class="text-gray text-sm font-normal uppercase">todos</span>
                </div>
            </div>
        </div>
        <div>
            <div class="w-full flex justify-between mb-8">
                <div class="flex items-center gap-4">
                    <a @click="" class="text-sm cursor-pointer py-1.5 px-6 rounded-full font-semibold border-tuna border-2 text-comet">
                        Toutes
                    </a>
                    <a @click="" class="text-sm cursor-pointer py-1.5 px-6 rounded-full font-semibold border-tuna border-2 text-comet">
                        Récemment mise à jour
                    </a>
                    <a @click="" class="text-sm cursor-pointer py-1.5 px-6 rounded-full font-semibold border-tuna border-2 text-comet">
                        Complétés
                    </a>
                </div>
                <div class="flex items-center bg-bright-gray rounded-full p-1">
                    <span class="mx-2 text-sm text-ghost-white">Nouveau todo</span>
                    <span class="ml-1 w-8 h-8 flex items-center justify-center border-comet border-2 text-comet rounded-full text-sm">
                        <i class="fa-solid fa-plus"></i>
                    </span>
                </div>
           </div>
           <div>
                <Todo v-for="task in todos" :key="task.id" :task="task"/>
           </div>
        </div>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue'
import { replaceDate } from '@/Utils/utils.js'
import Dropdown from '@/Components/DropdownTask.vue'
import Todo from '@/Components/Todo.vue'

const props = defineProps({
    tasks: Object,
    todos: Object,
})

const form = useForm({
    title: props.tasks[0].title,
    description: props.tasks[0].description,
})

const editMode = ref(false)

const favoriteTask = (id) => {
    Inertia.put(route('tasks.update.liked', id))
}

const editTask = (id) => {
    console.log('edit ', id);
    editMode.value = true
}

const deleteTask = (id) => {
    Inertia.delete(route("tasks.destroy", id));
}

const submit = () => {
    form.put(route('tasks.update', props.tasks[0].id), {
        preserveScroll: true,
        onSuccess: () => editMode.value = false
    })
}

</script>

