<template>
    <div>

        <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Register</h1>
                  </div>
                  <form class="user" @submit.prevent="signup">
                    <div class="form-group">
                      
                      <input type="text" class="form-control" id="exampleInputFirstName" v-model="form.name" placeholder="Enter Your Full Name">
                    </div>
                    
                    <div class="form-group">
                      <input type="email" class="form-control" id="exampleInputEmail" v-model="form.email" aria-describedby="emailHelp"
                        placeholder="Enter Email Address">
                        <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="exampleInputPassword" v-model="form.password" placeholder="Password">
                      <small class="text-danger" v-if="errors.password"> {{ errors.password[0] }}</small>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="exampleInputPasswordRepeat"  
                        placeholder="Confirm Password" v-model="form.password_confirmation">
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <hr>
                    
                  </form>
                  <hr>
                  <div class="text-center">
                    <router-link to="/"  class="font-weight-bold small">Already have an account?</router-link>
                  </div>
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
    if(User.loggedIn()){
      this.$router.push({ name: 'register' })
    }
  },
  data(){
      return{
        form:{
          name: null,
          email: null,
          password: null,
          password_confirmation: null
          
        },
        errors:{}
      }
  },
  methods:{
    signup(){
          axios.post('/api/auth/signup', this.form)
          .then(res => {
            User.responseAfterLogin(res)
            Toast.fire({
              icon: 'success',
              title: 'Signing up successfully'
            })
            this.$router.push({ name: 'home' })
            })
          .catch(error => this.errors = error.response.data.errors)
        }
  }
}
  
</script>

<style type="text/css">
</style>