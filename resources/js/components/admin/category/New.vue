<template>
  <div>
      <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Add Category</h4>
                </div>
                <div class="row" style="margin: 5px">
                    <div class="col-lg-12">
                        <form role="form" @submit.prevent="addCategory()">
                            <fieldset class="form-group">
                                <label>Category Name</label>
                                <input class="form-control" placeholder="Enter text" name="cate_name" v-model="form.cate_name"
                                :class="{ 'is-invalid': form.errors.has('cate_name') }">
                                <has-error :form="form" field="cate_name"></has-error>
                            </fieldset>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control">
                                    <option>Hiển Thị</option>
                                    <option>Không Hiển Thị</option>
                                </select>
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
    name: "New",
    data() {
        return {
            form: new Form({
                cate_name: ''
            })
        }   
    },
    methods: {
        addCategory() {
            this.form.post('/add-category')
            .then(response => {
                this.$router.push('/category-list')
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