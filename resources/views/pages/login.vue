<script setup>
    import { useForm } from '@inertiajs/inertia-vue3';

    let form = useForm({
        username: '',
        password: ''
    })

    function submit() {
        form.post('/login')
    }

</script>

<template>
    <div class="flex flex-col justify-center items-center min-h-screen">

        <h1 class="title-font text-8xl text-white mb-8">
            Raffler
        </h1>
        <div class="w-[500px] p-8 bg-primary rounded-xl shadow-md flex flex-col items-center justify-center text-white border border-green-300">
            <form @submit.prevent="submit()">
                <div class="flex flex-col space-y-2 mt-4">
                    <label for="username">User Name</label>
                    <input type="text" class="input" v-model="form.username">
                    <div class="text-red-700 italic" v-if="form.errors.username">{{ form.errors.username }}</div>
                </div>
                <div class="flex flex-col space-y-2 mt-4">
                    <label for="password">Password</label>
                    <input type="password" class="input" v-model="form.password">
                    <div class="text-red-700 italic" v-if="form.errors.password">{{ form.errors.password }}</div>
                </div>
                <div class="my-8 text-center">
                    <button class="btn btn-primary w-[200px]" :disabled="form.processing" type="submit">
                        Log In
                    </button>
                </div>
                <div class="text-sm text-red-700 italic" v-if="form.errors.authentication">{{ form.errors.authentication }}</div>
            </form>
        </div>

    </div>
</template>
