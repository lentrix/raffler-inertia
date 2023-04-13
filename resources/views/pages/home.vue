<script setup>
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    raffles: Array,
})

</script>


<template layout="default">

    <div class="text-right mb-8">
        <Link href="/raffles/create" class="p-4 bg-green-800 rounded-lg text-white text-xl hover:bg-green-700">+ Create New Raffle</Link>
    </div>

    <div class="mt-3 grid grid-cols-3 grid-flow-row gap-3">

        <div class="p-4 bg-gray-800 rounded-lg shadow-md" v-for="raffle in raffles" :key="raffle.id">
            <h3 class="text-2xl text-white">{{ raffle.name }}</h3>
            <p class="text-gray-400 italic">{{ raffle.description }}</p>
            <div class="mt-3 flex justify-between text-green-200">
                <div>Prizes: {{ raffle.prizes }}</div>
                <div>Entries: {{ raffle.entries }}</div>
                <div>Drawn: {{ raffle.draws }}</div>
            </div>
            <div class="mt-3 flex justify-between">
                <div class="flex space-x-2">
                    <Link :href="'/raffles/' + raffle.id" class="border border-blue-500 text-blue-500 p-2 rounded" title="Open Raffle">
                        <i class="fa-regular fa-folder-open"></i>
                    </Link>
                    <Link :href="'/raffles/edit/' + raffle.id" class="border border-green-500 text-green-500 p-2 rounded" title="Edit Raffle">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </Link>
                </div>
                <Link :href="'/raffles/delete/' + raffle.id" class="border border-red-500 text-red-500 p-2 rounded" title="Delete Raffle">
                    <i class="fa-solid fa-trash-can"></i>
                </Link>
            </div>
        </div>

    </div>

</template>
