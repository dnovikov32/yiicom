<template>

    <div v-if="isDev" class="yc-debug mt-3">
        <a class="btn btn-secondary btn-xs mb-2" href="#yc-debug" data-toggle="collapse">Отладка</a>

        <div class="collapse" id="yc-debug">
            <div class="card card-body">
                <pre>model: {{  model }}</pre>
            </div>
        </div>
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

        computed: {
            isDev: function () {
                return this.$store.getters['commerce/isDev'];
            }
        }

    }
</script>