import { createApp } from "vue";
import App  from './App.vue';
import axios from "axios";
import router from './router.js';

import '../../css/vue.css';


const app=createApp(App);
app.use(router);

app.config.globalProperties.$axios = axios;
window.axios=axios;

app.mount("#app");