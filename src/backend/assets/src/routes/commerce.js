import Dashboard from '../pages/Dashboard.vue';
import Login from '../pages/Login.vue';

const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard,
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
        component: Login,
        meta: { auth: false }
    },
];

export default routes;