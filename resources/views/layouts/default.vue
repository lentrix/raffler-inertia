<script setup>
// This is a persistent layout
// Include me with <template layout="default" />
    import NavBar from '../components/NavBar.vue'

</script>

<template>
    <div class="max-w-[1080px] lg:mx-auto mx-4 min-w-[480px]">
        <NavBar />
	    <slot />
    </div>
</template>
