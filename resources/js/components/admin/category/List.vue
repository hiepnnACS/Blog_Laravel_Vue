<template>
  <div>
     <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Category</h6>
                </div>
                 <div class="col-md-6">
                     <div class="float-right"> 
                       <router-link to="/add-category" class="btn btn-outline-success mr-auto">Add Category</router-link>
                    </div> 
                    
                </div>
                
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Chỉnh sửa</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Chỉnh sửa</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr v-for="(cate, index) in getAllCategory" :key="cate.id">
                                <td>{{ index+1 }}</td>
                                <td>{{ cate.cat_name }}</td>
                                <td>{{ cate.created_at | timeformat }}</td>
                                <td>Hiển thị</td>
                                <td>
                                    <router-link :to="{name: 'edit-category', params: {id_category: cate.id}}" class="btn btn-primary edit"><i class="fas fa-edit"></i></router-link>
                                    <button class="btn btn-danger delete" @click.prevent="deleteCategory(cate.id)"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
    name: "List",
    mounted() {
        this.$store.dispatch("allCategory")
    },
    computed: {
        getAllCategory() {
            return this.$store.getters.getCategory
        }
    },
    methods: {
        deleteCategory(id) {
            axios.get('/delete/' + id)
            .then(() => {
                this.$store.dispatch("allCategory")
                Toast.fire({
                    icon: 'success',
                    title: 'Delete Category in successfully'
                })
            })
            .catch(() => {

            })
        }
    }
}
</script>

<style>

</style>