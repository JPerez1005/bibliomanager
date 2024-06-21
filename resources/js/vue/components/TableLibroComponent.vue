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
  