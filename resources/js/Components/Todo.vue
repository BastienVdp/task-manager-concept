<template>
        <div class="flex bg-tuna my-4 py-3.5 px-14 rounded-lg text-comet">
            <div class="flex items-center w-64 gap-4">
                <i class="fa-regular fa-circle-check text-xl cursor-pointer"
                    @click="checkedTodo(task.id)"
                    :class="{ 'text-mint' : task.done }">
                </i>
                <input type="text"
                    v-model="form.name"
                    v-if="editMode"
                    class="p-0.5 w-20 indent-0.5 border-bright-gray rounded-lg bg-tuna focus:ring-0">
                <span v-else class="text-gray">
                    {{ task.name }}
                </span>
            </div>
            <div class="flex items-center justify-between gap-4 basis-full text-sm">
                <div>
                    <span><i class="fa-solid fa-comment-dots mx-3"></i>Description</span>
                    <input type="text"
                        v-model="form.description"
                        v-if="editMode"
                        class="p-0.5 w-30 ml-4 indent-1 border-bright-gray rounded-lg bg-tuna focus:ring-0">
                    <span v-else class="ml-5 text-gray truncate">
                        {{ task.description }}
                    </span>
                </div>
                <div class="flex items-center">
                    <div>
                        <span><i class="fa-solid fa-calendar-days mx-3"></i>Ajoutée le</span>
                        <span class="ml-5 text-gray">{{ replaceDate(task.created_at) }}</span>
                    </div>
                    <Dropdown v-if="!editMode" :component="'todo'" :todo="task" @edit="editTodo" @delete="deleteTodo" />
                    <button v-else @click="submit" class="ml-5 mr-[-.7rem] w-7 h-7 flex justify-center items-center text-ghost-white bg-medium-purple rounded-full relative">
                        <i class="fa-sharp fa-solid fa-check text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
</template>
<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue'
import Dropdown from '@/Components/DropdownTask.vue'
import { replaceDate } from '@/Utils/utils.js'

const props = defineProps({
    task: Object
})

const form = useForm({
    name: props.task.name,
    description: props.task.description,
})

const editMode = ref(false)

const checkedTodo = () => {
    Inertia.put(route('todos.update.state', props.task.id))
    // Inertia.get(route('tasks.check', props.task.id))
}

const editTodo = (id) => {
    console.log('edit ', id);
    editMode.value = true
}

const deleteTodo = (id) => {
    Inertia.delete(route("todos.destroy", id));
}

const submit = () => {
    form.put(route('todos.update', props.task.id), {
        preserveScroll: true,
        onSuccess: () => editMode.value = false
    })
}
</script>
