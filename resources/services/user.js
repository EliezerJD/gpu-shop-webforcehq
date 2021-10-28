import ApiConnection from  './api';
export  default  {

    getUsers(currentPage) {
        return ApiConnection().get('/api/users');
    },

    getUser(id) {
        return ApiConnection().get('/api/users/'+id);
    },

    storeUser(data) {
        return ApiConnection().post('/api/users',data);
    },

    updateUser(data,id) {
        return ApiConnection().put('/api/users/'+id,data);
    },
    deleteUser(id) {
        return ApiConnection().delete('/api/users/'+id);
    }

}