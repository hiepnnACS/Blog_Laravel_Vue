<template>
  <div>
      <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Add Post</h4>
                </div>
                <div class="row" style="margin: 5px">
                    <div class="col-lg-12">
                        <form role="form" @submit.prevent="addPost()">

                            <!-- title -->
                            <fieldset class="form-group">
                                <label>Post Title</label>
                                <input class="form-control" placeholder="Enter text" name="post_title" v-model="form.post_title"
                                :class="{ 'is-invalid': form.errors.has('post_title') }">
                                <has-error :form="form" field="post_title"></has-error>
                            </fieldset>

                            <!-- desction -->
                            <fieldset class="form-group">
                              <label for="">Description</label>
                              <markdown-editor v-model="form.post_desc"></markdown-editor>
                              <has-error :form="form" field="post_desc"></has-error>
                            </fieldset>

                            <!-- Category list choince -->
                            <div class="form-group">
                                <label>Category</label>
                                <select v-model="form.cate_id" class="form-control">
                                    <option :value="category.id" v-for="category in getAllCategory" :key="category.id"> {{ category.cat_name }} </option>
                                </select>
                            </div>

                            <!-- image -->
                            <div class="form-group">
                              <label for="">Image</label>
                              <input @change="changePhoto($event)" type="file" class="form-control" name="photo"
                              :class="{'is-invalid' : form.errors.has('photo') }">
                              <img :src="form.photo" alt="" width="250" height="200">
                              <has-error :form="form" field="photo"></has-error>
                            </div>

                            
                            <button type="submit" class="btn btn-success">Add Category</button>
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
  data() {
    return {
      form: new Form({
        post_title: '',
        post_desc: '',
        cate_id: '',
        photo: ''
      })
    }
  },
  mounted() {
    this.$store.dispatch('allCategory')
  },
  computed: {
    getAllCategory() {
      return this.$store.getters.getCategory
    }
  },
  methods: {
    changePhoto(event) {
      var file = event.target.files[0];
      if(file.size > 1048576) {
        Toast.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Something went wrong!',
          footer: '<a href>Why do I have this issue?</a>'
        })
      } else {
        var reader = new FileReader();
        reader.onload = event => {
          // The file's text will be printed here
          this.form.photo = event.target.result
        };
      }
      

      reader.readAsDataURL(file);
    },
    addPost() {
      this.form.post('/save-post')
      .then(response => {
        this.$router.push('/post-list')
        Toast.fire({
                    icon: 'success',
                    title: 'Add Category in successfully'
                })
      })
      .catch(error => {
                console.log('loi')
            })
    }
  }
}
</script>

<style>

</style>