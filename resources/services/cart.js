import ApiConnection from "./api";

export default  {

    getCart(id) {
        return new Promise((resolve , reject) => {
            ApiConnection().get('/api/carts/'+id).then((response)=>{
                resolve(response.data);
            }).catch((error)=> {
                reject(error.response);
            });
        });
    },
    storeCart() {
        return new Promise((resolve , reject)=> {
            ApiConnection().post('/api/carts',{})
                .then((response)=>{
                    resolve(response.data);
                })
                .catch((error)=>{
                    reject(error);
                });
        })
    },
     addItem(cartId, item) {
     	console.log(item)
        return new Promise((resolve , reject)=> {
            ApiConnection().post('/api/carts/'+cartId+'/items',item)
                .then( (response) => {
                    resolve(response.data);
                })
                .catch((error)=>{
                    reject(error);
                });
        });
    },
    removeItem(cartId,item) {
        return new Promise((resolve , reject)=> {
            ApiConnection().delete('/api/carts/'+cartId+'/items/'+item.id).then( (response) => {
                resolve(response.data);
            }).catch((error)=>{
                reject(error);
            });
        });
    },

}