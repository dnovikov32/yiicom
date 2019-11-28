<template>

    <b-breadcrumb v-if="items" :items="items"></b-breadcrumb>

</template>

<script>
    export default {

        props: {
            home: {
                type: Object,
                default: function () {
                    return {
                        text: 'Главная',
                        href: '/#/'
                    }
                }
            }
        },

        data () {
            return {
                items: []
            }
        },

        created: function () {
            this.initItems();
        },

        watch: {
            '$route' () {
                this.initItems();
            }
        },

        methods: {

            initItems () {
                this.items = this.$route.meta.breadcrumbs;

                if (this.items && this.home && this.home.text !== this.items[0].text) {
                    this.items.splice(0, 0, this.home);
                }
            }

        }

    }
</script>
