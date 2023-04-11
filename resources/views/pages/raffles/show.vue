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
        <div class="bg-gray-600 rounded text-white p-2 mt-2">
            Prizes drawn: {{ draws.length }}
        </div>

        <Link :href="'/raffles/draw/' + raffle.id" class="min-w-full bg-green-800 p-3 text-center mt-8 rounded-lg text-white text-2xl hover:bg-green-700 hover:shadow-md duration-200">
            <i class="fa-solid fa-check-double"></i> Draw Now
        </Link>
    </div>
    <div class="w-1/3">
        <h3 class="text-2xl">Raffle Prizes</h3>
    </div>
    <div class="w-1/3">
        <h3 class="text-2xl">Raffle Entries</h3>
    </div>

</div>

</template>
