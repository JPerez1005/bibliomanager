import { createRouter,createWebHashHistory } from "vue-router";

const routes = [
    {
        name: 'home',
        path: '/',
        redirect: '/vue'  // Redirigir la raíz a la ruta '/vue'
    },
];

const router=createRouter({
    history: createWebHashHistory(),
    routes:routes
});

export default router;