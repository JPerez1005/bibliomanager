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
