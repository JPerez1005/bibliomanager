<template>
  <section class="second">
    <div class="outer">
      <div class="inner">
        <div class="bg">
          <h2 class="section-heading">
            <div class="container">
                <div class="card">
                    <a class="titulo mb-10">Registrar Autor</a>
                    <div class="inputBox">
                        <input v-model="form.nombre" type="text" required>
                        <span>Nombre</span>
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
export default {
  async mounted() {
    // if (this.$route.params.slug) {
    //     try {
    //         const response = await this.$axios.get("/api/autor/slug/" + this.$route.params.nombre);
    //         this.autor = response.data;
    //         this.initAutor();
    //     } catch (error) {
    //         console.error("Error fetching post data:", error);
    //     }
    // }
    // this.getCategory();
  },
  data() {
    return {
        autor: '',
        form: {
          nombre: '',
        },
        errors: {
          nombre: '',
        },
        file:null,
        fileError:'',
        filesDaD:[],
        autores: []
    }
  },
  methods: {
        validations(error){
            console.error("Hubo algún error");
            console.log(error);
            console.warn(error.response.data);
            if (error.response.data.errors.title) {
                this.errors.nombre = error.response.data.errors.nombre[0];
            }
        },
        OkNotification(){
          alert("Datos enviados");
        },
        ErrorNotification(message){
          alert("Hubo algún error: "+message);
        },
        initAutor() {
            this.form.nombre = this.post.nombre;
        },
        upload(){
            this.fileError='';
            let formData=new FormData();
            formData.append('image',this.file);
            this.$axios.post('/api/post/upload/'+this.post.id,formData,{
                headers:{
                    'Content-Type':'multipart/form-data'
                }
            }).then((res)=>{
                console.log(res);
                this.OkNotification();
            }).catch((e)=>{
                if (e.response.data.message==this.fileError) {
                    this.fileError=e.response.data.message;
                } else {
                    console.log(e);
                    this.ErrorNotification("imagen no encontrada");
                }
            });
        },
        cleanErrorsForm() {
            // this.errors.nombre = '';
        },
        async getCategory() {
            try {
                const response = await this.$axios.get('api/category/all');
                this.categories = response.data;
            } catch (error) {
                console.error("Error fetching categories:", error);
            }
        },
        async enviar() {
          this.cleanErrorsForm();
          let response;
          if (this.autor=='') { //create
            try {
                response =await this.$axios.post('/api/autor', this.form);
                this.OkNotification();
              } catch (error) {
                this.validations();
              }
          } else { //update
              try {
                  response = await this.$axios.patch('/api/autor/'+this.autor.id, this.form);
                  this.OkNotification();
              } catch (error) {
                  this.validations();
              }
          }
        }
    },
}
</script>
<style>
</style>