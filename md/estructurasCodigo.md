en la carpeta routes de web colocar lo siguiente

```javascript
Route::get('/vue', function () {
    return view('vue');
});
```

ahora creamos ese archivo en vue con el nombre de vue.blade.php

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titulo</title>
    </head>
    <body>
        <div id="app"></div>
        
        
        @vite(['resources/js/vue/main.js'])
</body>
</html>
```

colocar lo siguiente en router.js

```javascript
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

```

así debe de ser main.js


```javascript
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

```