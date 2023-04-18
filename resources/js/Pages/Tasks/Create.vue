<template>
    <Head title="Dashboard" />

    <form @submit.prevent="submit">
        <div class="flex items-center">
            <Link :href="route('tasks.index')" class="mr-5 text-2xl text-ghost-white">
                <i class="fa-solid fa-chevron-left"></i>
            </Link>
            <h1 class="text-2xl font-semibold text-ghost-white">
                Créer une nouvelle tâche
            </h1>
        </div>

        <div class="mt-8 p-7 bg-tuna rounded-lg">
            <h2 class="text-lg font-semibold text-ghost-white">Informations</h2>
            <p class="text-sm font-semibold text-comet mt-1 mb-5">
                Remplissez les informations requises
            </p>
            <div class="relative mb-3">
                <InputLabel for="title" value="Titre" />
                <TextInput id="title" class="text-sm" type="text" v-model="form.title" autocomplete="title" />
                <InputError class="mt-2" :message="form.errors.title" />
            </div>
            <div class="relative mb-3">
                <InputLabel for="description" value="Description" />
                <TextInput id="description" type="text" class="text-sm" v-model="form.description" autocomplete="description" />
                <InputError class="mt-2" :message="form.errors.description" />
            </div>
            <div class="relative mb-3">
                <InputLabel for="priority" value="Priorité" />
                <select name="priority" v-model="form.priority"
                    class="w-full
                    text-comet
                    focus:border-comet
                    focus:ring-0
                    mt-2
                    bg-tuna
                    border-2
                    border-bright-gray
                    rounded-md
                    text-sm">
                    <option v-for="prio in priority" :value="prio">{{prio}}</option>
                </select>
            </div>
            <div class="relative">
                <InputLabel for="deadline" value="Deadline" />
                <TextInput id="deadline" type="date" v-model="form.deadline" class="text-comet text-sm" autocomplete="description" />
                <InputError class="mt-2" :message="form.errors.deadline" />
            </div>
        </div>
        <div class="p-7 mt-6 bg-tuna rounded-lg">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-lg font-semibold text-ghost-white">Todos</h2>
                    <p class="text-sm font-semibold text-comet mt-1 mb-5">
                        Ajoutez les todos à faire pour cette tâche
                    </p>
                </div>
                <span @click="addTodo">
                    <span class="w-6 h-6 flex items-center justify-center cursor-pointer border-bright-gray border-2 text-comet rounded-full text-xs">
                        <i class="fa-solid fa-plus"></i>
                    </span>
                </span>
            </div>
            <div v-for="(todo, index) in form.todos" class="relative w-full
            text-come
            mt-2
            mb-4
            bg-tuna
            border-2
            border-bright-gray
            rounded-md">
                <label class="block font-semibold text-sm bg-tuna absolute top-[-10px] left-4 px-2 text-gray">
                    Todo {{ index + 1}}
                </label>
                <input type="text" v-model="form.todos[index].name" class="w-full bg-tuna border-none focus:border-none focus:ring-0 rounded-xl placeholder:text-comet text-comet placeholder:text-sm" placeholder="Nom du todo">
                <InputError class="ml-3" :message="form.errors[`todos.${index}.name`]" />
                <input type="text" v-model="form.todos[index].description" class="w-full bg-tuna border-none focus:border-none focus:ring-0 rounded-xl placeholder:text-comet text-comet placeholder:text-sm" placeholder="Description du todo">
                <InputError class="ml-3 mb-2" :message="form.errors[`todos.${index}.description`]" />
            </div>

        </div>
       <InputSubmit />
    </form>
</template>

<script setup>
    import { Head, useForm, Link } from '@inertiajs/inertia-vue3';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import InputSubmit from '@/Components/InputSubmit.vue';

    const props = defineProps({
        priority: Object
    })

    const form = useForm({
        title: '',
        description: '',
        priority: 'Normal',
        deadline: new Date().toISOString().slice(0,10),
        todos: [
            {
                name: '',
                description: '',
            }
        ]

    })

    const addTodo = () => {
        form.todos.push({ name: '', description: ''});
    }

    const submit = () => {
        form.post(route('tasks.store'), {
            preserveScroll: true
        })
    }

</script>

