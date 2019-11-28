<template>

    <div class="h-100">

        <header v-if="$auth.check()">
            <navbar></navbar>
        </header>

        <div class="container-fluid h-100">

            <div v-if="$auth.ready()" class="row h-100">

                <notifications />

                <yc-loader :value="isLoading"></yc-loader>

                <div v-if="$auth.check()" class="col-2">
                    <sidebar></sidebar>
                </div>

                <div :class="$auth.check() ? 'col-10 pl-0' : 'col-12 pl-0'">
                    <breadcrumbs></breadcrumbs>

                    <router-view></router-view>
                </div>

            </div>

        </div>

        <footer class="row">
            <!-- Footer content here -->
        </footer>

    </div>

</template>

<script>
    import Sidebar from './Sidebar.vue';
    import Navbar from './Navbar.vue';
    import Breadcrumbs from "./Breadcrumbs.vue";

    export default {

        components: {
            Breadcrumbs,
            Sidebar,
            Navbar
        },

        created: function () {
            if (this.$auth.check() && _.isEmpty(this.settings)) {
                this.$store.dispatch('commerce/fetchSettings');
            }
        },

        computed: {
            isDev () {
                return this.$store.getters['commerce/isDev'];
            },
            isLoading () {
                return this.$store.getters['commerce/isLoading'];
            },
            settings () {
                return this.$store.getters['commerce/settings'];
            }
        },

        watch: {
            'settings' () {
                if (this.isDev) {
                    console.log('settings', this.settings);
                }
            }
        }

    }
</script>
