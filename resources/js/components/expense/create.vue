<template>
    <div>

        <div class="row">
            <router-link to="/expense" class="btn btn-info">All Expense</router-link>
        </div>

        <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Add Expense</h1>
                  </div>
                  <form class="user" @submit.prevent="expenseInsert" >
                    <div class="form-group">
                      <div class="form-row">
                           <div class="col-md-12">
                                <label for="exampleFormControlTextarea1"><b>Expense Details</b></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="form.details"></textarea>
                            </div> 
                            
                            <div class="col-md-12"><br>
                                <label for="exampleFormControlSelect1"><b>Expense Amount</b></label>
                                <input type="text" class="form-control" v-model="form.amount" 
                                placeholder="Enter Your Amount">
                                
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
          category_name: null,
          
        },
        errors:{}
      }
  },
  methods:{
      
    expenseInsert(){
        axios.post('/api/expense', this.form)
        .then((res) =>{
            console.log(res.data)
            this.$router.push({name: 'expense'})
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