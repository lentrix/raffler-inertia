<script setup>
import { useForm } from '@inertiajs/inertia-vue3';


let form = useForm({
    name: '',
    description: ''
})

function submit() {
    form.post('/raffles')
}

</script>

<template layout="default">

<div class="max-w-[600px] p-4 bg-green-600 rounded-lg shadow-lg mx-auto text-white">
    <h1 class="title-font text-3xl mb-6">Create Raffle</h1>

    <form @submit.prevent="submit()">

        <div class="flex flex-col mb-3">
            <label for="name">Name</label>
            <input type="text" class="input" v-model="form.name">
            <div class="italic text-red-800">{{ form.errors.name }}</div>
        </div>

        <div class="flex flex-col mb-3">
            <label for="description">Description</label>
            <textarea id="description" rows="3" class="input" v-model="form.description"></textarea>
        </div>

        <div>
            <button class="btn btn-primary">Create Raffle</button>
        </div>

    </form>
</div>

</template>
