import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    namespaced: true,

    state: {
        isLoading: false,
        errors: [],
        settings: {}
    },

    getters: {
        isDev (state) {
            return true;
        },
        isLoading (state) {
            return state.isLoading;
        },
        errors (state) {
            return state.errors;
        },
        hasError (state) {
            return state.errors.length > 0;
        },
        settings (state) {
            return state.settings;
        },
    },

    mutations: {
        SET_LOADER (state, value) {
            state.isLoading = value;
        },
        SET_ERRORS (state, errors) {
            state.errors = errors;
        },
        FETCH_SETTINGS_SUCCESS (state, data) {
            state.settings = data;
        },
    },

    actions: {
        loading ({state, commit, rootState}, value) {
            commit('SET_LOADER', value);
        },

        failing ({state, commit, rootState}, errors) {
            let messages = [];

            if (typeof errors.message !== 'undefined') {
                messages.push(errors.message);
            } else {
                errors.map(function (value) {
                    messages.push(value.message);
                });
            }

            commit('SET_ERRORS', messages);

            messages.map(function (value) {
                Vue.notify({type: 'error', text: value});
            });
        },

        fetchSettings ({state, commit, rootState}) {
            return Vue.axios.get('/admin/api/v1/settings/index')
                .then(
                    response => commit('FETCH_SETTINGS_SUCCESS', response.data),
                    error => {}
                );
        }
    }

});
