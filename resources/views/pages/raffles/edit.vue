<script setup>
import { Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    raffle: Object
})

let form = useForm({
    name: props.raffle.name,
    description: props.raffle.description,
})

function submit(raffle) {
    form.put('/raffles/' + raffle.id)
}

</script>

<template layout="default">

<div class="max-w-[600px] p-4 bg-green-600 rounded-lg shadow-lg mx-auto text-white">
    <h1 class="title-font text-3xl mb-6">Edit Raffle</h1>

    <form @submit.prevent="submit(raffle)">

        <div class="flex flex-col mb-3">
            <label for="name">Name</label>
            <input type="text" class="input" v-model="form.name">
            <div class="italic text-red-800">{{ form.errors.name }}</div>
        </div>

        <div class="flex flex-col mb-3">
            <label for="description">Description</label>
            <textarea id="description" rows="3" class="input" v-model="form.description"></textarea>
        </div>

        <div class="flex justify-between">
            <button class="btn btn-primary">Edit Raffle</button>
            <Link class="bg-orange-600 p-4 rounded-lg" href="/home">Cancel</Link>
        </div>

    </form>
</div>

</template>
