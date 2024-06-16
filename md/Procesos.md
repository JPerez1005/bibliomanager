<h1 align="center">Primeros Pasos:</h1>

<div align="left">

|Crear Proyecto|
|-|
|<pre><code class="bash">composer global remove laravel/installer</code></pre>|
|<pre><code class="bash">composer global require laravel/installer</code></pre>|
|<pre><code class="bash">laravel new nombre-del-proyecto</code></pre>|


</div>



<h1 align="center">Segundo Paso:</h1>

| Instalar Vue 3 | Colocar la Configuración en vite.config.js|
| ----------- | ----------- |
|<pre><code class="bash">npm install vue</code></pre>| <pre><code class="javascript">import vue from '@vitejs/plugin-vue';</code></pre> |
|<pre><code class="bash">npm install vue-loader</code></pre>| <h5>Agregamos Vue.js dentro de vite.config.js</h5> |
|<pre><code class="bash">npm install @vitejs/plugin-vue</code></pre>| <pre><code class="javascript">export default defineConfig({plugins: [vue(),]});</code></pre> |

|instalar vue-router|
|-|
|<pre><code class="bash">npm install vue-router@4</code></pre>|


<h1 align="center">Estructura</h1>

```bash
resources
│
├── css
│   ├── app.css
│   └── vue.css
│
├── js
│   ├── app.js
│   ├── bootstrap.js
│   └── vue
│       ├── App.vue
│       ├── main.js
│       ├── routes.js
│       └── components
│           └── EjemploComponent.vue
```

|Procesos de creacion por consola|
|-|
|<pre><code class="bash">cd resources</code></pre>|
|<pre><code class="bash">touch css/vue.css</code></pre>|
|<pre><code class="bash">mkdir js/vue</code></pre>|
|<pre><code class="bash">touch js/vue/App.vue js/vue/main.js js/vue/router.js</code></pre>|
|<pre><code class="bash">mkdir js/vue/components</code></pre>|

<h1 align="center">Tercer Paso:</h1>

|Intalar Taildwind| Exponer Taildwind |
|-|-|
|<pre><code class="bash">npm install -D tailwindcss postcss autoprefixer</code></pre>| <pre><code class="bash">npx tailwindcss init -p</code></pre> |

en el archivo tailwind.config.js agregamos en el array de content:

```javascript
    export default{
        content:[
            "./resources/js/**/*.{vue,js,ts,jxs,tsx}",
        ]
    }
```
creamos un archivo css de vue con lo siguiente

```css
    @import 'tailwindcss/base';
    @import 'tailwindcss/components';
    @import 'tailwindcss/utilities';
```

y lo importamos en el main.js por lo general es de la siguiente manera
import '../../css/vue.css';

<h1 align="center">Cuarto Paso:</h1>

|Crear Tablas|Tablas, modelos y controladores|
|-|-|
|<pre><code class="bash">php artisan make:migration create<nombre>Table</code></pre>| <pre><code class="javascript">php artisan make:migration create<nombre>Table -m -c</code></pre> |

|Realizar Las Migraciones|Actualizar Todas las migraciones|eliminar migración anterior|
|-|-|-|
|<pre><code class="bash">php artisan migrate</code></pre>| <pre><code class="bash">php artisan migrate:refresh</code></pre> |<pre><code class="bash">php artisan migrate:rollback</code></pre> |

<hr/>


<h1 align="center">Quinto Paso:</h1>

|Put Request|Store Request|
|-|-|
|<pre><code class="bash">php artisan make:request PutRequest</code></pre>| <pre><code class="bash">php artisan make:request StoreRequest</code></pre> |