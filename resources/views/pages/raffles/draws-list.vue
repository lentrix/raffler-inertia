<script setup>
import { Link } from '@inertiajs/inertia-vue3';


defineProps({
    raffle: Object,
    draws: Array
})

</script>


<template layout="default">

<div class="flex space-x-4">

    <div class="w-1/3">
        <div class="flex flex-col bg-green-100 p-2 rounded-lg shadow-md">
            <h3 class="text-2xl">{{ raffle.name }}</h3>
            <p class="text-gray-700 italic text-sm">{{ raffle.description }}</p>

            <Link :href="'/raffles/' + raffle.id" class="min-w-full bg-green-800 p-2 text-center mt-8 rounded-lg text-white text-2xl hover:bg-green-700 hover:shadow-md duration-200">
                <i class="fa-solid fa-left-long"></i> Back
            </Link>
        </div>
    </div>

    <div class="w-3/4">
        <h1 class="text-4xl">List of Prizes Drawn</h1>
        <hr class="border-green-700">

        <table class="table mt-3">
            <tr>
                <th>Name of Winner</th>
                <th>Prize</th>
                <th>Sponsor</th>
            </tr>
            <tr v-for="draw in draws">
                <td>
                    <div>{{ draw.entry.name }}</div>
                    <div class="text-sm text-gray-700 italic">{{ draw.entry.description }}</div>
                </td>
                <td>{{ draw.prize.name }}</td>
                <td>{{ draw.prize.sponsor }}</td>
            </tr>
        </table>
    </div>

</div>

</template>
