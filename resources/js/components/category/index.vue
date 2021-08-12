<template>
    <div>

        <div class="row">
            <router-link to="/store-supplier" class="btn btn-info">Add Category</router-link>
        </div>
    <br>
    <input type="text" v-model="searchTerm" class="form-control" style="width: 300px" placeholder="Search Here">
    <br>
    <div class="row">
        <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <tr >
                        <td><a href="#"></a></td>
                        
                        <td>
                          <router-link to="/" class="btn btn-sm btn-primary">Edit</router-link>
                          <a @click="deleteSupplier()" class="btn btn-sm btn-danger"><Font color="#ffffff">Delete</Font></a>
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
        suppliers: [],
        searchTerm: ''
      }
  },
  computed: {
    filtersearch(){
      
    }
  },
  methods:{
        allSupplier(){
          axios.get('/api/supplier/')
          .then(({data}) => (this.suppliers = data))
          .catch()
        },
        deleteSupplier(id){
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
                    axios.delete('/api/supplier/' + id, this.form)
                    .then(() => {
                        this.suppliers = this.suppliers.filter((supplier) => {
                            return supplier.id != id
                        })
                    })
                    .catch(() => {
                        this.$router.push({ name: 'supplier' })
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
      this.allSupplier();
    }
  }
  
</script>

<style type="text/css">
#sup_photo{
  height: 30px;
  width: 30px;
}
</style>