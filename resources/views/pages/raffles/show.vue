<script setup>
import { Link } from '@inertiajs/inertia-vue3';


defineProps({
    raffle: Object,
    prizes: Array,
    entries: Array,
    draws: Array
})


</script>

<template layout="default">

<div class="flex space-x-4">

    <div class="w-1/3 flex flex-col">
        <h3 class="text-2xl">{{ raffle.name }}</h3>
        <p class="text-gray-700 italic text-sm">{{ raffle.description }}</p>

        <div class="bg-gray-800 rounded text-white p-2 mt-2">
            Number of Entries: {{ entries.length }}
        </div>
        <div class="bg-gray-700 rounded text-white p-2 mt-2">
            Number of Prizes: {{ prizes.length }}
        </div>
        <Link :href="'/raffles/draws/' + raffle.id" class="bg-gray-600 rounded text-white p-2 mt-2 cursor-pointer hover:bg-gray-200 hover:text-black">
            Prizes drawn: {{ draws.length }}
        </Link>

        <Link :href="'/raffles/draw/' + raffle.id" class="min-w-full bg-green-800 p-3 text-center mt-8 rounded-lg text-white text-2xl hover:bg-green-700 hover:shadow-md duration-200">
            <i class="fa-solid fa-check-double"></i> Draw Now
        </Link>
    </div>
    <div class="w-1/3 p-4 rounded-lg shadow bg-green-200">
        <div class="flex justify-between">
            <h3 class="text-2xl">Raffle Prizes</h3>
            <Link :href="'/raffles/' + raffle.id + '/add-prizes'" class="bg-green-300 px-3 py-2 rounded-lg border border-green-400 hover:bg-green-500">
                <i class="fa-solid fa-right-to-bracket"></i>
            </Link>
        </div>
        <ul class="mt-3">
            <li v-for="prize in prizes" class="list-item">
                {{ prize.name }}
                <span v-if="prize.sponsor" class="italic text-green-600">
                    from {{ prize.sponsor }}
                </span>
            </li>
        </ul>
    </div>
    <div class="w-1/3 p-4 rounded-lg shadow bg-green-200">
        <div class="flex justify-between">
            <h3 class="text-2xl">Raffle Entries</h3>
            <Link :href="'/raffles/' + raffle.id + '/entries'" class="bg-green-300 px-3 py-2 rounded-lg border border-green-400 hover:bg-green-500">
                <i class="fa-solid fa-right-to-bracket"></i>
            </Link>
        </div>
        <div class="flex space-x-1 space-y-1 mb-1 flex-wrap">
            <div></div>
            <div v-for="entry in entries" :key="entry.id" class="small-box">
                {{ entry.name }}
            </div>
        </div>
    </div>

</div>

</template>
