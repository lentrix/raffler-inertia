<script setup>
// This is a persistent layout
// Include me with <template layout="default" />
    import NavBar from '../components/NavBar.vue'

    defineProps({
        errors: null
    })
</script>

<template>
    <div class="max-w-[1280px] xl:mx-auto mx-4 min-w-[480px]">
        <NavBar />

        <div v-if="errors.GeneralErrors" class="flex max-w-[800px] mx-auto p-2 bg-red-500 text-red-100 rounded-lg mb-2">
            {{ errors.GeneralErrors }}
        </div>

	    <slot />
    </div>
</template>
