<template>
    <section class="first">
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
                                nombre
                            </div>
                            <div class="table-col">
                                edad
                            </div>
                        </div>
                        <div class="table-row" data-copy="103" v-for="usuario in usuarios.data" :key="usuario.id" data-limit="9">
                            <div class="table-col">
                                <span class="auto-increment">{{ usuario.id }}</span>
                            </div>
                            <div class="table-col">
                                <span class="auto-firstname">{{ usuario.nombre }}</span>
                            </div>
                            <div class="table-col">
                                <span class="auto-firstname">{{ usuario.edad }}</span>
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
                usuarios:[],
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
                this.$axios.get('/api/usuario?page='+this.currentPage).then((res)=>{
                    console.log(res.data);
                    this.usuarios=res.data;
                    this.isLoading=false;
                });
            },
        }
    };
</script>