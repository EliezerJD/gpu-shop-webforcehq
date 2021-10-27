require('./bootstrap');

import Vue from 'vue';

import router from './routes/router';
import App from "../views/App";
import store from './store/main';

const app = new Vue({
    el: '#app',
    components:{App},
    router, store
});
