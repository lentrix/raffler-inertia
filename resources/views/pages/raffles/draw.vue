<script setup>
import { Link, useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

let xEntry = ref({
    ticket_no: null,
    name:'Pick a prize',
    description:'..................',
})

let drawState = ref({
    hasWinner: false,
    prize: null
})

let excludeWinners = ref(true)

defineProps({
    raffle: Object,
    draws: Array,
    non_winners: Array
})

let form = useForm({
    prize_id: '',
    entry_id: '',
})

function draw(prize, list) {
    var n = 50;

    drawState.value.hasWinner = false

    for(var i=0; i<100; i++) {
        setTimeout(()=>pick(list), 50*i)
    }

    setTimeout(()=>{
        drawState.value.hasWinner = true
        drawState.value.prize = prize
        drawState.bg = "bg-confetti"
    }, 50*101)
}

function pick(list) {
    let rnd = Math.floor(Math.random() * list.length)
    xEntry.value = list[rnd]
}

function trash() {
    drawState.value.hasWinner = false
    drawState.prize = null
    xEntry.value = {
        name: "Pick again",
        description: '....................'
    }
}

async function confirm(raffle) {
    form.prize_id = drawState.value.prize.id
    form.entry_id = xEntry.value.id

    await form.post('/raffles/draw/' + raffle.id)

    trash();
}

</script>

<template layout="default">

    <div class="flex space-x-4">

        <div class="w-1/4">
            <div class="flex flex-col bg-green-200 p-4 rounded-lg shadow mb-4">
                <h3 class="text-2xl">{{ raffle.name }}</h3>
                <p class="text-gray-700 italic text-sm">{{ raffle.description }}</p>

                <Link :href="'/raffles/' + raffle.id" class="min-w-full bg-green-800 p-2 text-center mt-8 rounded-lg text-white text-2xl hover:bg-green-700 hover:shadow-md duration-200">
                    <i class="fa-solid fa-left-long"></i> Back
                </Link>
            </div>

            <div class="flex flex-col bg-green-200 p-4 rounded-lg shadow mb-4">
                <h3 class="text-2xl mb-3">List of Winners</h3>
                <ul>
                    <li class="list-item" v-for="draw in draws">
                        <div>{{ draw.entry.name }}</div>
                        <div class="italic text-sm text-gray-700">{{ draw.prize.name }}</div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="w-3/4">
            <div class="bg-green-200 p-4 rounded-lg shadow mb-4">
                <div class="flex justify-between">
                    <h2 class="text-3xl">Raffle Draw</h2>
                    <div>
                        <input type="checkbox" name="" id="exclusivity" v-model="excludeWinners">
                        <label for="exclusivity">Draw from non-winners only</label>
                    </div>
                </div>
                <hr class="border-green-700">
                <h4 class="mt-4 text-xl">Select Raffle Item</h4>

                <div class="flex flex-wrap space-x-1 space-y-1">
                    <div></div>
                    <div class="flex flex-col bg-green-100 p-2 rounded shadow-md cursor-pointer hover:bg-white" v-for="prize in raffle.prizes" @click="draw(prize, excludeWinners ? non_winners : raffle.entries)">
                        <div></div>
                        <div class="font-bold">{{ prize.name }}</div>
                        <div class="italic text-gray-600">{{ prize.description }}</div>
                        <div>{{ prize.sponsor }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-green-200 flex flex-col items-center justify-center p-6 min-h-[300px] rounded-lg shadow mb-4" :class='{"bg-confetti": drawState.hasWinner}'>
                <h3 class="text-4xl text-red-500 mb-4" v-if="drawState.hasWinner">Congratulations!!!</h3>
                <h1 class="text-6xl">{{ xEntry.name }}</h1>
                <div class="text-xl italic">{{ xEntry.description }}</div>
                <div class="text-red-500 text-xl text-center mt-6" v-if="drawState.hasWinner">You have won a<br />
                    <span class="font-bold text-2xl">{{ drawState.prize?.name }}</span> <br> <span>from {{ drawState.prize?.sponsor }}</span></div>

                <div class="mt-6 flex space-x-2 items-center" v-if="drawState.hasWinner">
                    <button class="px-4 py-2 bg-green-800 hover:bg-green-700 text-white rounded-lg shadow" @click="confirm(raffle)">
                        <i class="fa fa-check"></i> Confirm
                    </button>
                    <button class="px-4 py-2 bg-red-800 hover:bg-red-700 text-white rounded-lg shadow" @click="trash()">
                        <i class="fa fa-trash"></i> Trash
                    </button>
                </div>
            </div>
        </div>

    </div>


</template>
