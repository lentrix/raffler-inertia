<script setup>
import { Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    raffle: Object
})

let form = useForm({
    name: '',
    ticket_no: '',
    description: ''
})

let form2 = useForm({
    'source_list': null
})

function addOne(id) {
    form.post('/raffles/' + id + '/entries')
    clearForm()
}

function addFile(id) {
    form2.post('/raffles/' + id + "/import-entries",{
        forceFormData: true
    })
}

function clearForm() {
    form.ticket_no = ''
    form.name = ''
    form.description = ''
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
            <h4 class="text-xl">Add Raffle Entries</h4>
            <hr class="border-green-700 mb-4">
            <form @submit.prevent="addOne(raffle.id)">
                <div class="flex flex-col">
                    <label for="ticket_no">Ticket No.</label>
                    <input type="text" id="ticket_no" class="input" v-model="form.ticket_no">
                </div>
                <div class="flex flex-col">
                    <label for="name">Entry Name</label>
                    <input type="text" id="name" class="input" v-model="form.name">
                    <div class="italic text-sm text-red-600" v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>
                <div class="flex flex-col">
                    <label for="description">Description</label>
                    <textarea class="input" id="description" rows="3" v-model="form.description"></textarea>
                    <div class="italic text-sm text-red-600" v-if="form.errors.description">{{ form.errors.description }}</div>
                </div>
                <button class="btn btn-primary mt-3" type="submit">
                    <i class="fa fa-save"></i> Save Prize
                </button>
            </form>

        </div>

        <div class="flex flex-col bg-green-200 p-4 rounded-lg shadow mb-4 overflow-hidden">
            <h4 class="text-xl">Import Raffle Entries</h4>
            <hr class="border-green-700 mb-4">
            <form @submit.prevent="addFile(raffle.id)">
                <input type="file" @input="form2.source_list = $event.target.files[0]" accept=".csv" />
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                {{ form.progress.percentage }}%
                </progress>

                <button class="btn btn-primary mt-3" type="submit">
                    <i class="fa-solid fa-file-arrow-down"></i> Import File
                </button>
            </form>
            <div>CSV Format: <br />Ticket No., Name, Description</div>
        </div>

    </div>
    <div class="w-3/4">
        <h2 class="text-4xl">Raffle Entries</h2>
        <hr class="border-green-700">
        <table class="table mt-4">
            <tr>
                <th>Ticket No.</th>
                <th>Name</th>
                <th>Other Details</th>
                <th>
                    <i class="fa fa-trash"></i>
                </th>
            </tr>
            <tr v-for="entry in raffle.entries" :key="entry.id">
                <td>{{ entry.ticket_no }}</td>
                <td>{{ entry.name }}</td>
                <td>{{ entry.description }}</td>
                <td class="text-center">
                    <Link :href="'/entries/' + entry.id" method="delete">
                        <i class="fa fa-trash text-red-700"></i>
                    </Link>
                </td>
            </tr>
        </table>
    </div>
</div>

</template>
