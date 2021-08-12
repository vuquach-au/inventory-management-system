<template>
    <div>

        <div class="row">
            <router-link to="/supplier" class="btn btn-info">All Category</router-link>
        </div>

        <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Add Category</h1>
                  </div>
                  <form class="user" @submit.prevent="supplierInsert" >
                    <div class="form-group">
                      <div class="form-row">
                           <div class="col-md-12">

                                <input type="text" class="form-control" v-model="form.category_name" 
                                placeholder="Enter Your Category Name">
                                <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}</small>
                            </div> 
                            

                            
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                    <hr>
                    
                  </form>
                  <hr>
                  
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
</template>

<script type="text/javascript">
export default {
  created(){
    if(!User.loggedIn()){
      this.$router.push({ name: '/' })
    }
  },
  data(){
      return{
        form:{
          name: null,
          email: null,
          phone: null,
          address: null,
          photo: null,
          shopname: null,
        },
        errors:{}
      }
  },
  methods:{
      onFileSelected(event){
          let file = event.target.files[0];
          if(file.size > 1048770){
              Notification.image_validation();
          } else {
              let reader = new FileReader();
              reader.onload = event => {
                  this.form.photo = event.target.result
                  console.log(event.target.result);
              }
              reader.readAsDataURL(file);
          }
      },
    supplierInsert(){
        axios.post('/api/supplier', this.form)
        .then((res) =>{
            console.log(res.data)
            this.$router.push({name: 'supplier'})
            Notification.success();
        })
        .catch(error => this.errors = error.response.data.errors)
        .catch(
            Toast.fire({
              icon: 'warning',
              title: 'Invalid Data Input!!'
            })
          )
    },
  }
}
  
</script>

<style type="text/css">
</style>