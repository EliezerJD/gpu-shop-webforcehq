require('./bootstrap');

import Vue from 'vue';

import router from './routes/router';
import App from "../views/App";
import store from './store/main';

router.beforeEach(async (to,from,next) => {
	if (store.getters.isLogin)
		await store.dispatch('profile');

    

    if ( to.matched.some(record => record.meta.requiredAuth) ) {
        if (store.getters.isAuth) {
            next();
        }
    }else{
        next();
    }

    if (to.matched.some(record => record.meta.requiredAdmin)){
        if (store.getters.isLogin && store.getters.isUserAdmin){
            next();
        }else{
            next({name:'default'});
        }
    }

    if ( to.matched.some(record => record.meta.requiredAuth) ) {
        if (store.getters.isLogin) {
            next();
        }else{
            next({name:'default'});
        }
    }


    

});
const app = new Vue({
    el: '#app',
    components:{App},
    router, store
});
