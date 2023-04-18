<template>
    <div @click="toggle" :class="classes">
        <i v-if="component == 'todo'" class="ml-8 fa-solid fa-ellipsis-vertical"></i>
        <i v-if="component == 'task'" class="fa-solid fa-ellipsis"></i>
        <ul v-if="open" :class="{ 'left-[1rem]': component == 'task'}" class="absolute left-[-4rem] w-24 p-1 text-sm text-left rounded-lg bg-bright-gray">
            <DropdownLink @click="$emit('edit', todo.id)">Editer</DropdownLink>
            <DropdownLink @click="$emit('delete', todo.id)">Supprimer</DropdownLink>
        </ul>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import DropdownLink from '@/Components/DropdownLinkTask.vue'

const props = defineProps({
    todo: Object,
    component: String,
    classes: {
        default: () => ['text-gray', 'text-lg', 'relative', 'cursor-pointer']
    }
})

const open = ref(false);

const toggle = () => {
    open.value = !open.value
}
</script>
