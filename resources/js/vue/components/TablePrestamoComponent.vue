<template>
    <section class="fourth">
        <div class="outer">
          <div class="inner">
            <div class="bg">
              <h2 class="section-heading">
                <div class="table-container" style="--data-limit: 9">
                    <div class="table" id="table-0" data-limit="9">
                        <div class="table-row table-heading">
                            <div class="table-col">
                                #
                            </div>
                            <div class="table-col">
                                prestamo
                            </div>
                            <div class="table-col">
                                devolucion
                            </div>
                            <div class="table-col">
                                devuelto
                            </div>
                            <div class="table-col">
                                usuario
                            </div>
                            <div class="table-col">
                                libro
                            </div>
                        </div>
                        <div class="table-row" data-copy="103" v-for="prestamo in prestamos.data" :key="prestamo.id" data-limit="9">
                            <div class="table-col">
                                <span class="auto-increment">{{ prestamo.id }}</span>
                            </div>
                            <div class="table-col">
                                <span class="auto-increment">{{ prestamo.fecha_de_prestamo }}</span>
                            </div>
                            <div class="table-col">
                                <span class="auto-firstname">{{ prestamo.fecha_de_devolucion }}</span>
                            </div>

                            <div class="table-col">
                                <span class="auto-firstname" v-if="prestamo.devuelto==1" >sí</span>
                                <span class="auto-firstname" v-if="prestamo.devuelto==0" >No</span>
                            </div>
                            <div class="table-col">
                                <span class="auto-firstname">{{ prestamo.usuario.nombre }}</span>
                            </div>
                            <div class="table-col">
                                <span class="auto-firstname">{{ prestamo.libro.titulo }}</span>
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
    export default{
        data(){
            return{
                prestamos:[],
                isLoading: true,
                currentPage:1,
            }
        },
        mounted() {
            this.listPage()
        },

        methods:{
            updatePage(){
                setTimeout(() => {
                    this.listPage()
                }, 100);
            },
            listPage(){
                this.isLoading=true,
                this.$axios.get('/api/prestamo?page='+this.currentPage).then((res)=>{
                    console.log(res.data);
                    this.prestamos=res.data;
                    this.isLoading=false;
                });
            },
        }
    };
</script>

<style>
.table-container {
    width: 90vw !important;
}
</style>