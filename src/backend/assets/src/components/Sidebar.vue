<template>

    <b-nav class="sidebar navbar-dark bg-dark">

        <li class="nav-item" v-for="(item, index) in adminMenu">

            <router-link :to="item.url"
                 class="nav-link"
                 :class="(isActive(item) ? 'active' : '') + ' ' +  (item.items ? 'dropdown-toggle' : '')"
                 :exact="item.url == '/'"
            >
                <i class="nav-icon" :class="item.icon"></i>{{ item.label }}
            </router-link>

            <div v-if="item.items" class="dropdown-menu" :class="isActive(item) ? 'show' : ''">
                <router-link v-for="(subitem, subindex) in item.items"
                     :to="subitem.url"
                     class="dropdown-item"
                     :class="isActive(subitem) ? 'active' : ''"
                >
                    <i class="nav-icon" :class="item.icon"></i>{{ subitem.label }}
                </router-link>
            </div>

        </li>

    </b-nav>

</template>

<script>
    export default {

        data () {
            return {
                parts: []
            };
        },

        computed: {
            settings () {
                return this.$store.getters['commerce/settings'];
            },
            adminMenu () {
                return _.isEmpty(this.settings) ? {} : this.settings.adminMenu;
            },
            module () {
                return this.parts[0];
            },
            controller () {
                return this.parts[1];
            },
            action () {
                return this.parts[2];
            },
            route () {
                return `/${this.module}/${this.controller}`;
            },
        },

        // TODO: route parts code repeats adminButtons component
        created: function () {
            this.setParts();
        },

        watch: {
            '$route': function () {
                this.setParts();
            }
        },

        methods: {
            setParts () {
                let parts = this.$route.path.split('/');
                this.parts = parts.filter(Boolean);
            },

            isActive (item) {
                let parts = item.url.split('/').filter(Boolean);
                let module = parts[0];
                let controller = parts[1];
                let action = parts[2];
                let route = `/${module}/${controller}`;

                if (item.items) {
                    return module === this.module;
                }

                return route === this.route;
            }
        }
    }
</script>
