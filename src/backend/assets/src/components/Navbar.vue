<template>

    <b-navbar type="dark" variant="dark" class="topbar">

        <b-navbar-brand class="text-uppercase" :href="frontendWeb" target="_blank">{{siteName}}</b-navbar-brand>

        <b-navbar-nav class="ml-auto">
            <b-nav-item @click="$auth.logout()" href="/"><i class="fa fa-sign-out-alt"></i> Выйти</b-nav-item>
        </b-navbar-nav>

    </b-navbar>

</template>

<script>
    export default {

        computed: {
            settings () {
                return this.$store.getters['commerce/settings'];
            },
            frontendWeb: function () {
                return _.isEmpty(this.settings) ? '#' : this.settings.frontendWeb;
            },
            siteName: function () {
                return _.isEmpty(this.settings) ? '' : this.settings.id;
            },
        }
    }
</script>
