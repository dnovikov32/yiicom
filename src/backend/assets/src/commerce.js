// TODO: how to organize vue components from different modules

window._ = require('lodash');

import Vue from 'vue'
import VueRouter from 'vue-router';
import axios from './axios'
import VueAxios from 'vue-axios'
import VueAuth from '@websanova/vue-auth';
import BootstrapVue from 'bootstrap-vue'; // TODO: try to create global script
import Notifications from 'vue-notification';
import VueCkeditor from 'vue-ckeditor2';
import VueUploadComponent from 'vue-upload-component';
import VueDraggable from 'vuedraggable';
import App from './components/App.vue';
import Loader from './components/Loader.vue';
import AdminButtons from './components/AdminButtons.vue';
import store from './store/commerce.js';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(BootstrapVue);
Vue.use(Notifications);

Vue.component('file-upload', VueUploadComponent);
Vue.component('draggable', VueDraggable);
Vue.component('vue-ckeditor', VueCkeditor);
Vue.component('yc-loader', Loader);
Vue.component('yc-admin-buttons', AdminButtons);

const router = new VueRouter({
    mode: 'hash',
    linkActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'dashboard',
            component: require('./views/Dashboard.vue'),
            meta: {
                auth: true,
                breadcrumbs: [
                    { text: 'Главная' }
                ]
            }
        },
        {
            path: '/login',
            name: 'login',
            component: require('./views/Login.vue'),
            meta: { auth: false }
        },
    ],
});

Vue.router = router;

Vue.use(VueAuth, {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
    loginData: {
        url: 'admin/api/v1/auth/login',
        redirect: '/',
        fetchUser: false
    },
    logoutData: {
        url: 'admin/api/v1/auth/logout',
        redirect: '/',
        makeRequest: true
    },
    refreshData: {
        url: 'admin/api/v1/auth/refresh',
        enabled: false,
        interval: 30
    },
    fetchData: {
        url: 'admin/api/v1/auth/user',
        enabled: false
    },
});

window.App = new Vue({
    store,
    router,
    render: h => h(App)
}).$mount('#app');
