<template>
    <div>
        <div class="row">
            <router-link to="/product" class="btn btn-info">All Products</router-link>
        </div>
        <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Add Product</h1>
                  </div>
                  <form class="user" @submit.prevent="productInsert" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="form-row">
                           <div class="col-md-6">
                             <label for="exampleFormControlSelect1">Product Name</label>
                                <input type="text" class="form-control" v-model="form.product_name" 
                                placeholder="Enter Your Product Name">
                            </div> 
                            <div class="col-md-6">
                              <label for="exampleFormControlSelect1">Product Code</label>
                                <input type="text" class="form-control" v-model="form.product_code" 
                                placeholder="Enter Product Code">
                            </div> 
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                           <div class="col-md-6">
                                <label for="exampleFormControlSelect1">Product Category</label>
                                <select class="form-control" v-model="form.category_id">
                                  <option :value="category.id" v-for="category in categories" :key="category.id" >
                                      {{ category.category_name }}
                                  </option>
                                </select>
                            </div> 
                            <div class="col-md-6">
                                <label for="exampleFormControlSelect1">Product Supplier</label>
                                <select class="form-control" v-model="form.supplier_id">
                                  <option :value="supplier.id" v-for="supplier in suppliers" :key="supplier.id" >
                                  {{ supplier.name }}</option>
                                </select>
                            </div> 
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                           <div class="col-md-4">
                             <label for="exampleFormControlSelect1">Product Root</label>
                                <input type="text" class="form-control" v-model="form.product_root" 
                                placeholder="Enter Product Root">
                            </div> 
                            <div class="col-md-4">
                              <label for="exampleFormControlSelect1">Buying Price</label>
                                <input type="text" class="form-control" v-model="form.buying_price" 
                                placeholder="Enter Buying Price">
                            </div> 
                            <div class="col-md-4">
                              <label for="exampleFormControlSelect1">Sellling Price</label>
                                <input type="text" class="form-control" v-model="form.selling_price" 
                                placeholder="Enter Sellling Price">
                            </div> 
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                           <div class="col-md-6">
                             <label for="exampleFormControlSelect1">Buying Date</label>
                                <input type="date" class="form-control" v-model="form.buying_date" 
                                placeholder="Enter Buying Date">
                            </div> 
                            <div class="col-md-6">
                              <label for="exampleFormControlSelect1">Product Quantity</label>
                                <input type="text" class="form-control" v-model="form.product_quantity" 
                                placeholder="Enter Product Quantity">
                            </div> 
                      </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                              <label for="exampleFormControlSelect1">Product Image</label>
                                <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div> 
                            <div class="col-md-6">
                                <img :src="form.image" style="height:40px; with:40px"/>
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
          product_name: null,
          product_code: null,
          category_id: null,
          supplier_id: null,
          root: null,
          buying_price: null,
          selling_price: null,
          buying_date: null,
          image: null,
          product_quantity: null,

        },
        errors:{},
        categories:{},
        suppliers:{}
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
                  this.form.image = event.target.result
                  console.log(event.target.result);
              }
              reader.readAsDataURL(file);
          }
      },
    productInsert(){
      
        axios.post('/api/product', this.form)
        .then(() => {
            this.$router.push({name: 'product'})
            Notification.success()
        })
        .catch(error => this.errors = error.response.data.errors)
        
    },
    
  },
  created(){
      axios.get('/api/category/')
      .then(({data}) => (this.categories = data))
      
      axios.get('/api/supplier')
      .then(({data}) => (this.suppliers = data))
    }
}
  
</script>

<style type="text/css">
</style>