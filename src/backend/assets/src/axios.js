import Axios from 'axios'

const axios = Axios.create();

axios.interceptors.request.use(
    config => {
        config.headers['Content-Type'] = 'application/json';

        let token = localStorage.getItem('token');

        if (token) {
            config.headers['Authorization'] = `Bearer ${ token }`;
        }

        // TODO: loook on
        // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        window.App.$store.dispatch('commerce/loading', true);
        window.App.$store.dispatch('commerce/failing', []);

        return config;
    },
    error => {
        window.App.$store.dispatch('commerce/loading', false);
        window.App.$store.dispatch('commerce/failing', error.response.data);

        return Promise.reject(error);
    }
);

axios.interceptors.response.use(
    response => {
        window.App.$store.dispatch('commerce/loading', false);
        window.App.$store.dispatch('commerce/failing', []);

        return response;
    },
    error => {
        if (401 === error.response.status) {
            window.App.$auth.logout({
                redirect: {name: 'login'}
            });
        }

        window.App.$store.dispatch('commerce/loading', false);
        window.App.$store.dispatch('commerce/failing', error.response.data);

        return Promise.reject(error);
    }
);

export default axios;
