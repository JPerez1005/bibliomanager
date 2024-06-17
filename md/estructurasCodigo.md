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

# Estructuras de modelos de datos

## migracion

<p align="center">Migración crea la tabla en la base de datos, aquí se define el nombre de la tabla y los campos que obtiene</p>

```php
    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::create('libro', function (Blueprint $table) {
                $table->id();
                $table->string('titulo',30);
                $table->integer('stock');
                $table->foreignId('autor_id')->constrained('autor')->onDelete('cascade');
                // $table->timestamps();
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('libro');
        }
    };

```

## modelo

<p align="center">el modelo se comunica con la tabla de la base de datos y con los controladores, aquí hay que definir con cual nombre o que migración hay que conectar simplemente definiendo el nombre, hay dos tipos de modelos con distintas relaciones, uno a muchos y muchos a uno, conexiones de tablas en otras palabras son de la siguiente forma:</p>

<p align="left">NOTA:recordar que el timestamp es necesario para guardar el momento en el que se registró algún dato, no siempre es necesario cabe aclarar.</p>

### tabla padre

```php
    <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Autor extends Model
    {
        use HasFactory;

        public $timestamps = false;
        
        protected $fillable=['nombre'];
        
        protected $table = 'autor';

        function libros(){
            return $this->hasMany(Libro::class);
        }
    }
```

### tabla hijo

```php
    <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Libro extends Model
    {
        use HasFactory;

        public $timestamps = false;

        protected $fillable=['titulo','stock','autor_id'];

        public function autor(){
            return $this->belongsTo(Autor::class,'autor_id');
        }
    }
```

## validación de datos

<p align="center">los request son necesarios para la validación de los datos</p>

|StoreRequest|PutRequest|
|-|
|<pre><code class="bash">php artisan make:request StoreRequest</code></pre>|<pre><code class="bash">php artisan make:request StoreRequest</code></pre>|

<h5 align="center">Este sería un ejemplo de codigo para los request</h5>

```php
    <?php

    namespace App\Http\Requests\libro;

    use Illuminate\Foundation\Http\FormRequest;

    class PutRequest extends FormRequest
    {
        public function authorize(): bool
        {
            return false;
        }

        public function rules(): array
        {
            return [
                'nombre'=>'required|min:5|max:500',
                'stock'=>'required|integer',
                'autor_id'=>'required|integer',
            ];
        }
    }

```

## controlador

<p align="center">Los controladores se comunican con los modelos y con las rutas del api, a la vez pueden hacer las validaciones rapidamente con los request, el siguiente codigoes un ejemplo de un controlador</p>



```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\autor\PutRequest;
use App\Http\Requests\autor\StoreRequest;
use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function all(){
        return response()->json(Autor::get());
    }

    public function index()
    {
        // Para las paginaciones
        return response()->json(Autor::paginate(10));
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Autor::create($request->validated()));
    }

    public function show(Autor $Autor)
    {
        return response()->json($Autor);
    }

    // Busqueda por nombre
    public function showBySlug(String $nombre)
    {
        $Autor=Autor::where('nombre',$nombre)->firstOrFail();
        return response()->json($Autor);
    }

    public function update(PutRequest $request, Autor $autor)
    {
        $autor->update($request->validated());
        return response()->json($autor);
    }

    public function destroy(Autor $autor)
    {
        $autor->delete();
        return response()->json('ok');
    }
}

```