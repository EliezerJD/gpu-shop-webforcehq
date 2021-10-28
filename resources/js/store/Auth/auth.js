import AuthService from '../../../services/auth';

const state = {
    token:localStorage.getItem('token') || null,
    user:{}
}

const getters = {
    isLogin() {
        return state.token !== null;
    },
    getUser() {
    	//console.log(state.user)
        return state.user;
    },
    isUserAdmin(state) {
        if (state.user) {
            if (state.user.role === 'admin') {
                return true;
            }
        }
        return false;
    },
    isGuest() {
        return state.token === null;
    },
};

const  mutations  = {

    setToken(state, token) {
        state.token = token;
    },
    setUser(state,user) {
        state.user = user;
    },
    logout(state){
        state.token = null;
        state.user = null;
    }

};

const actions = {
    saveToken(context , token){
        context.commit('setToken', token);
    },
    deleteDataUser(context, token, user){
    	context.commit('logout');
    },
    profile(context) {
        return new Promise((resolve , reject) => {
            AuthService.profile().
                then((response)=>{
                    const user = response.data;
                    context.commit('setUser',user);
                    resolve(response);
                }).catch((error)=>{
                    context.commit('logout')
                    reject(error)
                })
        });
    }
};

export default {
    namespace:true,
    state,
    getters,
    actions,
    mutations
}