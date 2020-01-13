import AdminHome from './components/admin/AdminHome.vue'
import CategoryList from './components/admin/category/List.vue'
import CategoryAdd from './components/admin/category/New.vue'
import CategoryEdit from './components/admin/category/Edit.vue'
import PostList from './components/admin/post/List.vue'
import PostAdd from './components/admin/post/New.vue'
import PostEdit from './components/admin/post/Edit.vue'

export const routes = [
    {
        path: '/home',
        component: AdminHome
    },
    {
        path: '/category-list',
        component: CategoryList
    },
    {
        path: '/add-category',
        component: CategoryAdd
    },
    {
        path: '/edit-category/:id_category',
        name: 'edit-category',
        component: CategoryEdit
    },
    // post
    {
        path: '/post-list',
        component: PostList
    },
    {
        path: '/add-post',
        component: PostAdd
    },
    {
        path: '/edit-post/:id_post',
        name: 'edit-post',
        component: PostEdit
    },
];