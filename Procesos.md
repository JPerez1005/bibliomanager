# primeros pasos:

### crear proyecto con laravel=>

```bash
    composer global remove laravel/installer
    composer global require laravel/installer
    laravel new nombre-del-proyecto
```

<hr>

# Segundo paso:

### instalar vue3=>
```bash
    npm install vue
    npm install vue-loader

    npm install @vitejs/plugin-vue
```
### vite.config.js=> 
```javascript
    import vue from '@vitejs/plugin-vue';
```
### agregamos vue(), dentro de plugins en ese mismo archivo=>
```javascript
    export default defineConfig({
    plugins: [
        vue(),
    ]
    });
```

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