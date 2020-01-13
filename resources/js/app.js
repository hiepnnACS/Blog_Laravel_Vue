
require('./bootstrap');
window.Vue = require('vue');

// --------------> support vuex <-----------------
import Vuex from 'vuex'

Vue.use(Vuex)

import storeData from "./store/index.js"
const store = new Vuex.Store(
    storeData
)

// ------------> editor
import 'v-markdown-editor/dist/index.css';

import Editor from 'v-markdown-editor'

Vue.use(Editor);

// -------------> support moment js <-----------------
import {fillter} from './fillter.js'

// -------------> Vue Roter <-------------------------
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import {routes} from './routes.js'
// -------

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-main', require('./components/admin/AdminMaster.vue').default);

// v-form
import { Form, HasError, AlertError } from 'vform'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

window.Form = Form;
// --------

// Thong bao
import Swal from 'sweetalert2'
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  window.Toast = Toast

const router = new VueRouter({
    routes
})
// ?----------
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.config.devtools = true
const app = new Vue({
    el: '#app',
    router,
    store
});
