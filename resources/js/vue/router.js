import { createRouter,createWebHashHistory } from "vue-router";
import Usuarios from './components/UsuarioComponent.vue';
import Prestamos from './components/PrestamoComponent.vue';
import Libros from './components/LibroComponent.vue';
import Autores from './components/AutorComponent.vue';
import TablaAutores from './components/TableAutorComponent.vue';
import TablaLibros from './components/TableLibroComponent.vue';
import TablaUsuarios from './components/TableUsuarioComponent.vue';
import TablaPrestamos from './components/TablePrestamoComponent.vue';
import Presentacion from './components/PresentacionComponent.vue';

const routes = [
    {
        name: 'home',
        path: '/',
        redirect: '/vue'  // Redirigir la raíz a la ruta '/vue'
    },
    {
        name: 'presentacion',
        path: '/inicio',
        component: Presentacion
    },
    {
        name: 'usuarios',
        path: '/usuario',
        component: Usuarios
    },
    {
        name: 'prestamos',
        path: '/prestamo',
        component: Prestamos
    },
    {
        name: 'libros',
        path: '/libro',
        component: Libros
    },
    {
        name: 'autores',
        path: '/autor',
        component: Autores
    },
    {
        name: 'tabla_autores',
        path: '/tabla_autor',
        component: TablaAutores
    },
    {
        name: 'tabla_libros',
        path: '/tabla_libro',
        component: TablaLibros
    },
    {
        name: 'tabla_usuarios',
        path: '/tabla_usuario',
        component: TablaUsuarios
    },
    {
        name: 'tabla_prestamos',
        path: '/tabla_prestamo',
        component: TablaPrestamos
    },
];

const router=createRouter({
    history: createWebHashHistory(),
    routes:routes
});

export default router;