<template>
  <div>
      <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Edit Category</h4>
                </div>
                <div class="row" style="margin: 5px">
                    <div class="col-lg-12">
                        <form role="form" @submit.prevent="editCategory()">
                            <fieldset class="form-group">
                                <label>Category Name</label>
                                <input class="form-control" placeholder="Enter text" name="cat_name" v-model="form.cat_name"
                                :class="{ 'is-invalid': form.errors.has('cat_name') }">
                                <has-error :form="form" field="cat_name"></has-error>
                            </fieldset>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control">
                                    <option>Hiển Thị</option>
                                    <option>Không Hiển Thị</option>
                                </select>
                            </div>      
                            <button type="submit" class="btn btn-success">Edit</button>
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
        axios.get(`/edit-category/${this.$route.params.id_category}`)
             .then(response => {
                 console.log(response.data.category)
                 this.form.fill(response.data.category)
             })
    },
    data() {
        return {
            form: new Form({
                cat_name: ''
            })
        }
    },
    methods: {
        editCategory() {
            this.form.post(`/update-category/${this.$route.params.id_category}`)
            .then((response)=> {
                this.$router.push('/category-list')

                Toast.fire({
                    icon: 'success',
                    title: 'Add Category in successfully'
                })
            })
        }
    }
}
</script>

<style>

</style>