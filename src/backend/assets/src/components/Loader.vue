<template>

    <div v-if="isLoading" class="yc-loader">

        <div class="progress">
            <div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

    </div>

</template>

<script>
    export default {

        props: {
            value: {
                type: Boolean
            }
        },

        computed: {
            isLoading: function () {
                let isLoading = this.value;

                if (typeof isLoading === 'undefined') {
                    isLoading = this.$store.getters['isLoading'];
                }

                return isLoading;
            }
        }

    }
</script>