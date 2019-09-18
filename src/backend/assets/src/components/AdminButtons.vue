<template>

    <div class="yc-admin-btns mb-2">

        <b-button
            v-if="isVisible('index')"
            variant="info"
            size="xs"
            :to="`${route}/index`"
        >
            <i class="fa fa-list-ul"></i> Список
        </b-button>

        <b-button
            v-if="isVisible('create')"
            variant="success"
            size="xs"
            :to="`${route}/create`"
            title="Добавить"
        >
            <i class="fa fa-plus-square"></i> Создать
        </b-button>

        <b-button
            v-if="isVisible('delete')"
            variant="danger"
            size="xs"
            @click="destroy"
            title="Удалить"
        >
            <i class="fa fa-trash"></i> Удалить
        </b-button>

        <b-button
            v-if="isVisible('view') && alias"
            variant="info"
            size="xs"
            :href="alias"
            target="_blank"
            title="Добавить новую страницу"
        >
            <i class="fa fa-eye"></i> Просмотр
        </b-button>

        <b-button
            v-if="isVisible('save')"
            variant="primary"
            size="xs"
            @click="save"
            title="Сохранить"
        >
            <i class="fa fa-save"></i> Сохранить
        </b-button>

    </div>

</template>

<script>
    export default {

        props: {
            model: {
                type: Object,
                default: function () {
                    return {};
                }
            }
        },

        data () {
            return {
                parts: [],
                actions: {
                    index: ['create'],
                    create: ['index', 'save'],
                    update: ['index', 'delete', 'create', 'view', 'save'],
                }
            };
        },

        computed: {
            settings () {
                return this.$store.getters['settings'];
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
            alias () {
                if (typeof this.model.url === 'undefined') {
                    return false;
                }

                if (this.model.url.alias) {
                    return this.settings.frontendWeb + '/' + this.model.url.alias;
                }

                return false;
            }
        },

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

            isVisible (button) {
                let buttons = this.actions[this.action];

                return buttons && buttons.indexOf(button) !== -1;
            },

            save (event) {
                this.$emit('save', event);
            },

            destroy (event) {
                let result = confirm('Вы уверены?');

                if (result) {
                    this.$emit('destroy', event);
                }
            }
        }

    }
</script>

<style scoped>

</style>