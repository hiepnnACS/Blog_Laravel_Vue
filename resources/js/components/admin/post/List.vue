<template>
  <div>
     <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
                </div>
                 <div class="col-md-6">
                     <div class="float-right"> 
                       <router-link to="/add-post" class="btn btn-outline-success mr-auto">Add Post</router-link>
                    </div> 
                    
                </div>
                
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>User</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Decription</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(post, index) in getAllPost" :key="index.id">
                                <td>{{ index + 1 }}</td>
                                <td> {{ post.user.name }} </td>
                                <td> {{ post.category.cat_name }} </td>
                                <td> {{ post.title }} </td>
                                <td> {{ post.description | sortlength(30, '...') }} </td>
                                <td>  <img :src="ourImage(post.photo)" alt=""> </td>
                                <td>
                                    <router-link :to="{name: 'edit-post', params: {id_post: post.id}}" class="btn btn-primary"><i class="fa fa-edit"></i></router-link>
                                    <button class="btn btn-danger" @click="deletePost(post.id)"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>User</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Decription</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
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
    mounted() {
        this.$store.dispatch('allPost')
    },
    computed: {
        getAllPost() {
            return this.$store.getters.getPost
        }
    },
    methods: {
        ourImage(img) {
            return 'uploadimage/'+img;
        },
        deletePost(id) {
            axios.get('/delete-post/'+id)
            .then(response => {
                this.$store.dispatch('allPost') 

                Toast.fire({
                    icon: 'success',
                    title: 'Delete Category in successfully'
                })
            })
        }
    }
}
</script>

<style>

</style>