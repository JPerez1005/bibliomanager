<h1 align="center">Primeros Pasos:</h1>

<p align="center">

|Crear Proyecto|
|-|
|<pre><code class="bash">composer global remove laravel/installer</code></pre>|
|<pre><code class="bash">composer global require laravel/installer</code></pre>|
|<pre><code class="bash">laravel new nombre-del-proyecto</code></pre>|


</p>


<h1 align="center">Segundo Paso:</h1>

| Instalar Vue 3 | Colocar la Configuración en vite.config.js|
| ----------- | ----------- |
|<pre><code class="bash">npm install vue</code></pre>| <pre><code class="javascript">import vue from '@vitejs/plugin-vue';</code></pre> |
|<pre><code class="bash">npm install vue-loader</code></pre>| <h5>Agregamos Vue.js dentro de vite.config.js</h5> |
|<pre><code class="bash">npm install @vitejs/plugin-vue</code></pre>| <pre><code class="javascript">export default defineConfig({plugins: [vue(),]});</code></pre> |


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



<h1 align="center">Tercer Paso:</h1>

|Intalar Taildwind| Exponer Taildwind |
|-|-|
|<pre><code class="bash">npm install -D tailwindcss</code></pre>| <pre><code class="javascript">npx tailwindcss init</code></pre> |

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
## crear tablas y modelos

```bash
php artisan make:migration create<nombre>Table
```

### para crear todo rapido se usaria el comando:

```bash
php artisan make:migration create<nombre>Table -m -c
```

## ejecutar migraciones

```bash
php artisan migrate
```

tambien las podemos eliminar y volver a crearlas

```bash
php artisan migrate:refresh
```

o solo poder eliminar la anterior

```bash
php artisan migrate:rollback
```

<hr/>


<h1 align="center">Quinto Paso:</h1>
crear los request

```bash
php artisan make:request PutRequest
php artisan make:request StoreRequest
```