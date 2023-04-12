<script setup>
import { Link } from '@inertiajs/inertia-vue3';



</script>

<template>

    <div class="flex justify-between py-8">

        <div id="branding" class="text-3xl title-font text-black">Raffler</div>
        <nav class="flex items-center">
            <Link href="/home" class="main-nav">My Raffles</Link>
            <Link href="/profile" class="main-nav">Profile</Link>
            <Link href="/logout" method="post" class="main-nav" as="button">Logout</Link>
        </nav>

    </div>

</template>
