require('./bootstrap');
import 'bootstrap/dist/js/bootstrap.bundle';

import App from './App.vue';
import { createApp } from 'vue';
import router from './system/router';

createApp(App)
    .use(router)
    .mount('#app');
