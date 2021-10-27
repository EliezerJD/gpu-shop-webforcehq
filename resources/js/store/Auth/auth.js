const state = {
    token:localStorage.getItem('token') || null,
    user:localStorage.getItem('user') || null,
}

const getters = {
    isLogin() {
        return state.token !== null;
    },
    getUser() {
    	//console.log(state.user)
        return state.user;
    },
};

const  mutations  = {

    setDataUser(state,token, user) {
        state.token = token;
        state.user = token.user;
    },
    logout(state){
        state.token = null;
        state.user = null;
    }

};

const actions = {
    saveDataUser(context , token, user){
        context.commit('setDataUser',token, user);
    },
    deleteDataUser(context, token, user){
    	context.commit('logout');
    }
};

export default {
    namespace:true,
    state,
    getters,
    actions,
    mutations
}