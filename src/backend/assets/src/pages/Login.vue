<template>

    <b-form @submit="submit" class="login-form">

        <b-card
            header="Вход"
            header-class="text-white bg-secondary"
            no-body
        >

            <b-card-body>

                <b-form-group
                    label="Логин"
                    label-for="login"
                    label-cols-sm="3"
                >
                    <b-form-input
                        id="login"
                        type="text"
                        v-model="form.login"
                        required
                        trim />
                </b-form-group>

                <b-form-group
                    label="Пароль"
                    label-for="password"
                    label-cols-sm="3"
                >
                    <b-form-input
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                        trim />
                </b-form-group>

                <b-button type="submit" variant="primary" :disabled="isLoading" class="offset-sm-3">Войти</b-button>

            </b-card-body>

        </b-card>

    </b-form>

</template>

<script>
    export default {

        data () {
            return {
                form: {
                    login: '',
                    password: ''
                }
            }
        },

        computed: {
            isLoading: function () {
                return this.$store.getters['isLoading'];
            },
            hasError: function () {
                return this.$store.getters['hasError'];
            }
        },

        methods: {
            submit() {
                this.$auth.login({
                    data: this.form,
                    rememberMe: true,
                    // fetchUser: false,
                    // redirect: '/',
                });
            }
        }

    }
</script>
