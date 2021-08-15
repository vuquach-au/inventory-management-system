<template>
    <div>

        <div class="row">
            <router-link to="/store-product" class="btn btn-info">Add Product</router-link>
        </div>
    <br>
    <input type="text" v-model="searchTerm" class="form-control" style="width: 300px" placeholder="Search Here">
    <br>
    <div class="row">
        <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Code</th>
                        <th>Category</th>
                        <th>Buying Price</th>
                        <th>Selling Price</th>
                        <th>Root</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="product in products" :key="product.id">
                        <td><a href="#">{{ product.product_name }}</a></td>
                        <td><img :src="product.image" id="prod_photo"></td>
                        <td>{{ product.product_code }}</td>
                        <td>{{ product.category_name }}</td>
                        <td>{{ product.buying_price }}</td>
                        <td>{{ product.selling_price }}</td>
                        <td>{{ product.root }}</td>
                        <td>
                          <router-link :to="{name: 'edit-product', params:{id:product.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                          <a @click="deleteProduct(product.id)" class="btn btn-sm btn-danger"><Font color="#ffffff">Delete</Font></a>
                        </td>
                         <td></td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->
         
            

    
    
    
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
        products: [],
        searchTerm: ''
      }
  },
  computed: {
    filtersearch(){
      return this.product.filter(product => {
        return product.name.match(this.searchTerm)
      })
    }
  },
  methods:{
        allProduct(){
          axios.get('/api/product/')
          .then(({data}) => (this.products = data))
          .catch()
        },
        deleteProduct(id){
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                axios.delete('/api/product/' + id)
                .then(() => {
                  this.products = this.products.filter(product => {
                    return product.id != id
                  })
                })
                .catch(() => {
                  this.$router.push({ name: 'employee' })
                })
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }
            })
        }

  },
    created(){
      this.allProduct();
    }
  }
  
</script>

<style type="text/css">
#prod_photo{
  height: 30px;
  width: 30px;
}
</style>