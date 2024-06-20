import { createApp } from "vue";
import App  from './App.vue';
import axios from "axios";
import router from './router.js';
import { createPinia } from 'pinia';
import piniaPersistedState from 'pinia-plugin-persistedstate';

import '../../css/vue.css';
import '../../css/formularios.css';
import '../../css/tablas.css';
// import '../../css/tabla.css';

const pinia = createPinia();
pinia.use(piniaPersistedState);

const app=createApp(App);
app.use(router).use(pinia);

app.config.globalProperties.$axios = axios;
window.axios=axios;

app.mount("#app");