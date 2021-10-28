import Vue from 'vue';
import VueRouter from 'vue-router';
import Default from "../../components/Default";
import Products from "../../views/Products";
import Info from "../../views/Info";
import Checkout from "../../views/Checkout";


//Admin
import Admin from "../../views/Admin";
import ListUsersPage from "../../views/admin/users/ListUsersPage";
import EditUsersPage from "../../views/admin/users/EditUsersPage";
import ListProductsPage from "../../views/admin/products/ListProductsPage";
import EditProductsPage from "../../views/admin/products/EditProductsPage";


Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'default',
        component: Default
    },
    {
        path: '*',
        redirect: '/',
    },
    {
        path: '/products',
        name: 'products',
        component: Products
    },
    {
        path: '/product/:arg',
        name: 'info',
        component: Info
    },
    {
        path: '/checkout',
        name: 'checkout',
        component: Checkout,
        meta: {requiredAuth: true}
    },


    {
        path: '/admin',
        name: 'admin',
        component: Admin,
        meta: {requiredAdmin: true}
    },

    {
        path: '/admin/users', 
        component: ListUsersPage, 
        name: 'listUsers',
        meta: {requiredAdmin:true}
    },

    {
        path: '/admin/users/:id/edit', 
        component: EditUsersPage, 
        name: 'editUsers',
        meta: {requiredAdmin: true}
    },
    {
        path:'/admin/products', 
        component: ListProductsPage, 
        name: 'listProducts',
        meta: {requiredAdmin:true}
    },
    {
        path: '/admin/products/:product_id/:slug/edit', 
        component: EditProductsPage, 
        name: 'editProducts',
        meta: {requiredAdmin:true}
    },
]
export default new VueRouter({ mode: 'history', routes: routes })

