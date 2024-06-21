# crear solo un controlador

ejemplo del controlador

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MultiModelController extends Controller
{
    // Lista de modelos que se pueden usar en este controlador
    protected $models = [
        'autor' => \App\Models\Autor::class,
        'libro' => \App\Models\Libro::class,
        'prestamo' => \App\Models\Prestamo::class,
        'usuario' => \App\Models\Usuario::class,
    ];

    // Método para obtener el modelo basado en el tipo
    protected function getModel($type)
    {
        if (!isset($this->models[$type])) {
            abort(404, "Modelo no encontrado.");
        }
        return new $this->models[$type];
    }

    // Listar todos los registros
    public function all($type)
    {
        $model = $this->getModel($type);
        return response()->json($model::all());
    }

    // Paginación
    public function index($type)
    {
        $model = $this->getModel($type);
        return response()->json($model::paginate(10));
    }

    // Crear un nuevo registro
    public function store(Request $request, $type)
    {
        $model = $this->getModel($type);
        $validatedData = $request->validate($model::validationRules()); // Aquí deberías definir los métodos de validación en cada modelo
        $instance = $model::create($validatedData);
        return response()->json(['message' => ucfirst($type) . ' creado con éxito', 'data' => $instance], 201);
    }

    // Mostrar un registro específico
    public function show($type, $id)
    {
        $model = $this->getModel($type);
        $instance = $model::findOrFail($id);
        return response()->json($instance);
    }

    // Actualizar un registro
    public function update(Request $request, $type, $id)
    {
        $model = $this->getModel($type);
        $instance = $model::findOrFail($id);
        $validatedData = $request->validate($model::validationRules());
        $instance->update($validatedData);
        return response()->json($instance);
    }

    // Eliminar un registro
    public function destroy($type, $id)
    {
        $model = $this->getModel($type);
        $instance = $model::findOrFail($id);
        $instance->delete();
        return response()->json(['message' => ucfirst($type) . ' eliminado con éxito']);
    }
}
```

ejemplo del api: recordar exponer la api en laravel 11

```php
php artisan install:api
```

ruta de la api

```php
use App\Http\Controllers\MultiModelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user',
function (Request $request) {
    return $request->user();
});



Route::prefix('{type}')->group(function () {
    Route::get('/all', [MultiModelController::class, 'all']);
    Route::get('/paginate', [MultiModelController::class, 'index']);
    Route::post('/', [MultiModelController::class, 'store']);
    Route::get('/{id}', [MultiModelController::class, 'show']);
    Route::put('/{id}', [MultiModelController::class, 'update']);
    Route::delete('/{id}', [MultiModelController::class, 'destroy']);
});
```

sí se creará solo un modelo de crontrolador entonces no es necesario crear los request ejemplo:

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

    protected $table = 'libro';

    public function autor(){
        return $this->belongsTo(Autor::class,'autor_id');
    }

    function prestamos(){
        return $this->hasMany(Prestamo::class);
    }

    public static function validationRules()
    {
        return [
            'titulo'=>'required|min:5|max:500',
            'stock'=>'required|integer',
            'autor_id'=>'required|integer',
        ];
    }
}
```

ahora se crea una carpeta de store y coloca cada uno de los componentes necesarios

```javascript
// src/stores/libroStore.js
import { defineStore } from 'pinia';
import axios from 'axios';

export const useLibroStore = defineStore('libro', {
  state: () => ({
    libros: [],
    isLoading: false,
  }),
  actions: {
    setLibros(libros) {
      this.libros = libros;
    },
    agregarLibro(libro) {
      this.libros.push(libro);
    },
    async fetchLibros() {
      this.isLoading = true;
      try {
        const response = await axios.get('http://bibliomanager.test/api/libro/paginate?page=1');
        console.log(response.data);  // Verificar la estructura de la respuesta
        this.setLibros(response.data.data);  // Ajustamos para acceder a `data` de la respuesta.
      } catch (error) {
        console.error("Error al cargar los libros:", error);
      } finally {
        this.isLoading = false;
      }
    },
  },
  persist: true, // Agrega esta línea para habilitar la persistencia
});

```

de esta manera de se ven los datos:

```php
<template>
    <section class="third">
      <div class="outer">
        <div class="inner">
          <div class="bg">
            <h2 class="section-heading">
              <div class="table-container" style="--data-limit: 9">
                <div class="table" id="table-0" data-limit="9">
                  <div class="table-row table-heading">
                    <div class="table-col">#</div>
                    <div class="table-col">titulo</div>
                    <div class="table-col">stock</div>
                  </div>
                  <div
                    class="table-row"
                    data-copy="103"
                    v-for="libro in libros"
                    :key="libro.id"
                    data-limit="9"
                  >
                    <div class="table-col">
                      <span class="auto-increment">{{ libro.id }}</span>
                    </div>
                    <div class="table-col">
                      <span class="auto-firstname">{{ libro.titulo }}</span>
                    </div>
                    <div class="table-col">
                      <span class="auto-firstname">{{ libro.stock }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </h2>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script>
  import { useLibroStore } from '../store/LibroStore.js';
  import { onMounted, computed } from 'vue';
  
  export default {
    setup() {
      const libroStore = useLibroStore();
  
      onMounted(() => {
        libroStore.fetchLibros(); // Cargar libros cuando el componente se monta
      });
  
      const libros = computed(() => libroStore.libros);
      const isLoading = computed(() => libroStore.isLoading);
  
      return {
        libros,
        isLoading,
      };
    },
  };
  </script>
```

de esta manera se mandan los datos:
```php
<template>
  <section class="third">
      <div class="outer">
        <div class="inner">
          <div class="bg">
            <h2 class="section-heading">
              <div class="container">
                  <div class="card">
                      <a class="titulo mb-10">Registrar Autor</a>
                          <div class="inputBox">
                              <input v-model="form.titulo" type="text" required>
                              <span>Titulo</span>
                          </div>
                          <div class="inputBox">
                              <input v-model="form.stock" type="number" required>
                              <span>Stock</span>
                          </div>
                          <div class="inputBox">
                              <select v-model="form.autor_id" required>
                                  <option v-for="autor in autores" :key="autor.id" :value="autor.id">{{autor.nombre}}</option>
                              </select>
                              <span>Autor</span>
                          </div>
                          <button class="enter" @click="enviar">Registrar</button>
                  </div>
              </div>
            </h2>
          </div>
        </div>
      </div>
    </section>
</template>

<script>
import { useLibroStore } from '../store/LibroStore.js'; // Asegúrate de que esta ruta sea correcta
import { useRouter } from 'vue-router';

export default {
setup() {
  const libroStore = useLibroStore();
  const router = useRouter();

  return {
    libroStore,
    router
  };
},
async mounted() {
  this.getAutor();
},
data() {
  return {
      libro: '',
      form: {
        titulo: '',
        stock: '',
        autor_id: '',
      },
      autores: []
  };
},
methods: {
  async getAutor() {
    try {
        const response = await this.$axios.get('api/autor/all');
        this.autores = response.data;
    } catch (error) {
        console.error("Error fetching autores:", error);
    }
  },
  async enviar() {
    try {
      const response = await this.$axios.post('/api/libro', this.form);
      alert("Libro registrado");

      // Utiliza el store de libro para agregar el nuevo libro
      this.libroStore.agregarLibro(response.data);

      // Redirige a la página de libros
      this.router.push({ name: 'tabla_libros' });
    } catch (error) {
      console.error("Error registrando el libro:", error);
    }
  }
},
}
</script>

```
