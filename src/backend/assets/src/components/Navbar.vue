<template>

    <b-navbar type="dark" variant="dark" class="topbar">

        <b-navbar-brand href="/" target="_blank">REFORM-CITY.RU</b-navbar-brand>

        <b-navbar-nav class="ml-auto">
            <b-nav-item @click="$auth.logout()" href="/"><i class="fa fa-sign-out-alt"></i> Выйти</b-nav-item>
        </b-navbar-nav>

    </b-navbar>

</template>

<script>
    export default {

    }
</script>
