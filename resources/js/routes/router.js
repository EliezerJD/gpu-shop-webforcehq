import Vue from 'vue';
import VueRouter from 'vue-router';
import Default from "../../components/Default";
import Products from "../../views/Products";
import Info from "../../views/Info";


Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'default',
        component: Default
    },
    {
        path: '/products',
        name: 'products',
        component: Products
    },
    {
        path: '/info',
        name: 'info',
        component: Info
    },
]
export default new VueRouter({ mode: 'history', routes: routes })

