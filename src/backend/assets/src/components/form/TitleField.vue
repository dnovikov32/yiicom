<template>
    <b-form-group
        label="Заголовок"
        label-for="title"
        label-cols-sm="2"
        description="Заголовок страница h1. Если пусто, то используется поле Название"
    >
        <b-form-input
            id="title"
            type="text"
            v-model="model.title"
            trim />
    </b-form-group>
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

        created: function () {
            this.initEvent(true);
        },

        watch: {
            'model.id' () {
                this.initEvent(false);
            }
        },

        methods: {
            initEvent (isComponentCreation) {
                let self = this;

                // TODO: try to remake to Vue
                $(function (isComponentCreation) {
                    if (self.model.id || self.model.title) {
                        return false;
                    }

                    let $name = $('input[id="name"]');

                    $name.on('keyup.titleField', function() {
                        self.model.title = self.model.name;
                    });

                    if (isComponentCreation) {
                        $name.on('focus.titleField', function () {
                            if (self.model.title) {
                                $name.unbind('keyup.titleField');
                            }
                        });

                        $name.on('blur.titleField', function () {
                            $name.unbind('keyup.titleField');
                        });
                    }
                });
            }
        }

    }
</script>