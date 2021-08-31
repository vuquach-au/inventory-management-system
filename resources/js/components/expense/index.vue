<template>
    <div>

        <div class="row">
            <router-link to="/store-expense" class="btn btn-info">Add Expense</router-link>
        </div>
    <br>
    <input type="text" v-model="searchTerm" class="form-control" style="width: 300px" placeholder="Search Here">
    <br>
    <div class="row">
        <div class="col-lg-6 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expense List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Details</th>
                        <th>Amount</th>
                        <th>Expense date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="expense in filtersearch" :key="expense.id">
                        <td><a href="#">{{ expense.details}}</a></td>
                        <td><a href="#">{{ expense.amount}}</a></td>
                        <td><a href="#">{{ expense.expense_date}}</a></td>
                        <td>
                          <router-link :to="{ name: 'edit-expense', params: { id: expense.id }}" class="btn btn-sm btn-primary">Edit</router-link>
                          <a @click="deleteExpense(expense.id)" class="btn btn-sm btn-danger"><Font color="#ffffff">Delete</Font></a>
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
        expenses: [],
        searchTerm: ''
      }
  },
  computed: {
    filtersearch(){
      return this.expenses.filter(expense => {
          return expense.details.match(this.searchTerm)
      })
    }
  },
  methods:{
        allExpense(){
          axios.get('/api/expense/')
          .then(({data}) => (this.expenses = data))
          .catch()
        },
        deleteExpense(id){
            Swal.fire({
                title: 'Are you sure to delete Expense number ' + id +' ?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/expense/' + id, this.form)
                    .then(() => {
                        this.expenses = this.expenses.filter((expense) => {
                            return expense.id != id
                        })
                    })
                    .catch(() => {
                        console.log('Error Deleting Expense');
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
      this.allExpense();
    }
  }
  
</script>

<style type="text/css">

</style>