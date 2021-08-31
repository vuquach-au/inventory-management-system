<template>
    <div>

        <div class="row">
            <router-link to="/employee" class="btn btn-info">All Employee</router-link>
        </div>

        <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"> Pay Salary</h1>
                  </div>
                  <form class="user" @submit.prevent="salaryPaid" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="form-row">
                           <div class="col-md-6">
                                <label for="exampleFormControlSelect1">Name</label>
                                <input type="text" class="form-control" id="" v-model="form.name" 
                                placeholder="Enter Your Full Name">
                            </div> 
                            <div class="col-md-6">
                                <label for="exampleFormControlSelect1">Email</label>    
                                <input type="email" class="form-control" id="" v-model="form.email" 
                                placeholder="Enter Your Email">
                            </div> 

                            
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-row">
                           <div class="col-md-6">
                                <label for="exampleFormControlSelect1">Months</label>
                                <select class="form-control" v-model="form.salary_month">
                                   <option value="JAN">JAN</option>
                                   <option value="FEB">FEB</option>
                                   <option value="MAR">MAR</option>
                                   <option value="APR">APR</option>
                                   <option value="MAY">MAY</option>
                                   <option value="JUN">JUN</option>
                                   <option value="JUL">JUL</option>
                                   <option value="AUG">AUG</option>
                                   <option value="SEP">SEP</option>
                                   <option value="OCT">OCT</option>
                                   <option value="NOV">NOV</option>
                                   <option value="DEC">DEC</option>
                                </select>
                            </div> 
                            <div class="col-md-6">
                                <label for="exampleFormControlSelect1">Salary</label>        
                                <input type="text" class="form-control" id="" v-model="form.salary" 
                                placeholder="Enter Your Salary">
                            </div> 
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Pay Now</button>
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
          name: '',
          email: '',
          salary: ',',
          salary_month: ''
        },
        errors:{}
      }
  },
  created(){
      let id = this.$route.params.id
      axios.get('/api/employee/' + id)
      .then(({data}) => (this.form = data))
      .catch(console.log('error'));
  },
  methods:{
      
    salaryPaid(){
        let id = this.$route.params.id
        axios.post('/api/salary/paid/' + id, this.form)
        .then(() => {
            this.$router.push({name: 'given-salary'})
            Notification.success()
        })
        .catch(error => this.errors = error.response.data.errors)
    },
  }
}
  
</script>

<style type="text/css">
</style>