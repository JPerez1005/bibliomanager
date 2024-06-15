<style>
    .padre{
        display:flex;
        flex-direction:row;
        gap: 4%;
    }
</style>

# primeros pasos:

### crear proyecto con laravel=>

```bash
    composer global remove laravel/installer
    composer global require laravel/installer
    laravel new nombre-del-proyecto
```

<hr>

# Segundo paso:

<center>

| Instalar Vue 3 | Colocar la Configuración en vite.config.js|
| ----------- | ----------- |
|<pre><code class="bash">npm install vue</code></pre>| <pre><code class="javascript">import vue from '@vitejs/plugin-vue';</code></pre> |
|<pre><code class="bash">npm install vue-loader</code></pre>| <h5>Agregamos Vue.js dentro de vite.config.js</h5> |
|<pre><code class="bash">npm install @vitejs/plugin-vue</code></pre>| <pre><code class="javascript">export default defineConfig({plugins: [vue(),]});</code></pre> |


<h1>Estructura</h1>

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

</center>




# Tercer paso:
### instalar taildwind=>
```bash
    npm install -D tailwindcss
```
### exponerlo=>
```bash
    npx tailwindcss init
```

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

# cuarto paso:
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


# Quinto paso:
crear los request

```bash
php artisan make:request PutRequest
php artisan make:request StoreRequest
```

| Repository Activity Trends | Collaborative Productivity - Last 28 days |
| ----------- | ----------- |
|<img src="https://next.ossinsight.io/widgets/official/compose-activity-trends/thumbnail.png?repo_id=41986369&image_size=auto" />|<img src="https://next.ossinsight.io/widgets/official/compose-last-28-days-collaborative-productivity/thumbnail.png?repo_id=41986369&image_size=auto" />|
