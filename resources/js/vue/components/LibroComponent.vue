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
