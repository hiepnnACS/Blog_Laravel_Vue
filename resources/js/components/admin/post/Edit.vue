<template>
  <div>
      <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Edit Post</h4>
                </div>
                <div class="row" style="margin: 5px">
                    <div class="col-lg-12">
                        <form role="form" @submit.prevent="updatePost()">

                            <!-- title -->
                            <fieldset class="form-group">
                                <label>Post Title</label>
                                <input class="form-control" placeholder="Enter text" name="title" v-model="form.title"
                                :class="{ 'is-invalid': form.errors.has('title') }">
                                <has-error :form="form" field="title"></has-error>
                            </fieldset>

                            <!-- desction -->
                            <fieldset class="form-group">
                              <label for="">Description</label>
                              <markdown-editor v-model="form.description" name="desc"></markdown-editor>
                              <has-error :form="form" field="post_desc"></has-error>
                            </fieldset>

                            <!-- Category list choince -->
                             <div class="form-group" >
                                    <label>Select</label>
                                    <select class="form-control" v-model="form.cate_id">
                                        <option disabled value="">Select One</option>
                                        <option :value="category.id" v-for="category in getAllCategory" :key="category.id">{{category.cat_name}}</option>

                                    </select>
                                    <has-error :form="form" field="cat_id"></has-error>
                                </div>
                            <!-- image -->
                            <div class="form-group">
                              <label for="">Image</label>
                              <input @change="changePhoto($event)" type="file" class="form-control" name="photo"
                              :class="{'is-invalid' : form.errors.has('photo') }">
                              <img :src="updateImage()" alt="" width="250" height="200">
                              <has-error :form="form" field="photo"></has-error>
                            </div>

                            
                            <button type="submit" class="btn btn-success">Edit Category</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
  </div>
</template>

<script>
export default {
     name: "Edit",
     
    mounted() {
        this.$store.dispatch('allCategory')
    },
    created() {
        axios.get(`/edit-post/${this.$route.params.id_post}`)
        .then(response => {
            this.form.fill(response.data.post)
        })
        .catch(error => {
            console.log('loi')
        })
    },
    computed: {
        getAllCategory()
        {
            return this.$store.getters.getCategory
        }
    },
    data() {
        return {
            form: new Form({
                title: '',
                description: '',
                photo: '' ,
                cate_id: ''
            })
        }
    },
    methods: {
        updateImage() {
            return "/uploadimage/" +this.form.photo;
        },
        updatePost() {
            this.form.post(`/update-post/${this.$route.params.id_post}`)
            .then(resp => {
                this.$router.push('/post-list')
                Toast.fire({
                    icon: 'success',
                    title: 'Edit Category in successfully'
                })
            })
        },
        changePhoto(event) {
            let file = event.target.files[0];
            if(file.size>1048576){
                Toast.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: '<a href>Why do I have this issue?</a>'
                })
            }else{
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.photo = event.target.result
                    console.log(event.target.result)
                };
                reader.readAsDataURL(file);
            }
        },
         updateImage(){
                let img = this.form.photo;
                if(img.length>100){
                    return  this.form.photo
                }else{
                    return `uploadimage/${this.form.photo}`
                }
            }
    }
}
</script>

<style>

</style>