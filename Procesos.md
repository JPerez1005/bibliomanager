primeros pasos:
crear proyecto con laravel=>
```bash
    composer global remove laravel/installer
    composer global require laravel/installer
    laravel new nombre-del-proyecto
```
Segundo paso:
instalar vue3=>
npm install vue
npm install vue-loader

npm install @vitejs/plugin-vue

vite.config.js=> import vue from '@vitejs/plugin-vue'
agregamos vue(), dentro de plugins en ese mismo archivo

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


Tercer paso:
instalar taildwind:
npm install -D tailwindcss
exponerlo: 
npx tailwindcss init

en el archivo tailwind.config.js agregamos en el array de content:
"./resources/js/**/*.{vue,js,ts,jxs,tsx}"

creamos un archivo css de vue con lo siguiente
@import 'tailwindcss/base';
@import 'tailwindcss/components';
@import 'tailwindcss/utilities';

y lo importamos en el main.js por lo general es de la siguiente manera
import '../../css/vue.css';

cuarto paso:
crear tablas y modelos

php artisan make:migration create<nombre>Table

para crear todo de uns se usaria el comando 
php artisan make:migration create<nombre>Table -m -c

ejecutar migraciones
php artisan migrate

tambien las podemos eliminar y volver a crearlas
php artisan migrate:refresh

o solo poder eliminar la anterior
php artisan migrate:rollback

Quinto paso:
crear los request
php artisan make:request PutRequest
php artisan make:request StoreRequest
