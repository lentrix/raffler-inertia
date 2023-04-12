<script setup>
import { Link, useForm } from '@inertiajs/inertia-vue3';


defineProps({
    raffle: Object,
})

let form = useForm({
    name: '',
    description: '',
    sponsor: ''
})

function addOne(id) {
    form.post('/raffles/' + id + '/prizes')
    clearForm()
}

function clearForm() {
    form.name = ''
    form.description = ''
    form.sponsor = ''
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
            <h4 class="text-xl">Add Raffle Prizes</h4>
            <hr class="border-green-700 mb-4">
            <form @submit.prevent="addOne(raffle.id)">
                <div class="flex flex-col">
                    <label for="name">Item Name</label>
                    <input type="text" id="name" class="input" v-model="form.name">
                    <div class="italic text-sm text-red-600" v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>
                <div class="flex flex-col">
                    <label for="description">Item Description</label>
                    <textarea class="input" id="description" rows="3" v-model="form.description"></textarea>
                </div>
                <div class="flex flex-col">
                    <label for="sponsor">Sponsor</label>
                    <input type="text" id="sponsor" class="input" v-model="form.sponsor">
                </div>
                <button class="btn btn-primary mt-3" type="submit">
                    <i class="fa fa-save"></i> Save Prize
                </button>
            </form>
        </div>

    </div>

    <div class="w-3/4">
        <h2 class="text-4xl">Raffle Prizes</h2>
        <hr class="border-green-700">
        <table class="mt-3 table" v-if="raffle.prizes.length > 0">
            <tr>
                <th>Item</th>
                <th>Description</th>
                <th>Sponsor</th>
                <th>
                    <i class="fa fa-trash"></i>
                </th>
            </tr>
            <tr v-for="prize in raffle.prizes" :key="prize.id">
                <td>{{ prize.name }}</td>
                <td>{{ prize.description }}</td>
                <td>{{ prize.sponsor }}</td>
                <td class="text-center">
                    <Link :href="'/prizes/' + prize.id" method="delete" title="Delete item">
                        <i class="fa fa-trash text-red-700"></i>
                    </Link>
                </td>
            </tr>
        </table>
        <div v-if="raffle.prizes.length==0" class="mt-3 text-gray-600 italic">There are no raffle prizes yet.</div>
    </div>

</div>


</template>
