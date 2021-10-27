import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);
import auth from './Auth/auth';

import cart from './Cart/shoppingCart';

const store = new Vuex.Store({
    modules:{
        auth,
        cart
    }
});

export default  store;