import ApiConnection from "./api";

export default {

    login(userCredentials) {
        return new Promise((resolve , reject)=> {
            ApiConnection().post('/api/login',{
                email:userCredentials.email,
                password:userCredentials.password
            }).then((response)=>{
                const res = response.data.data_token;
                const user = res.user;
                localStorage.setItem('token', res.token);
                localStorage.setItem('user',user.name);
                resolve(res);
            }).catch((error)=>{
                reject(error);
            });
        });
    },

    logout() {
        return new Promise((resolve, reject) => {
            ApiConnection().post('/api/logout')
                .then(response => {
                    localStorage.removeItem('token')
                    localStorage.removeItem('user')
                    resolve(response)
                })
                .catch(error => {
                    reject(error)
                })
        })
    }, 

    profile() {
        return new Promise((resolve , reject)=>{
           ApiConnection().get('/api/users/profile')
               .then((response)=>{
                   resolve(response);
               }).catch((error)=>{
                   localStorage.removeItem('token');
                   reject(error);
               });
        });
    },

}