
   
import ApiConnection from "./api";

export default  {

    getProducts() {
        return ApiConnection().get('/api/products');
    },
    getProductsPage(currentPage) {
        return ApiConnection().get('/api/products?page='+currentPage);
    },

    getProduct(arg) {
        return ApiConnection().get('/api/product/'+arg);
    },

    getProductEdit(id,slug) {
        return ApiConnection().get('/api/products/'+id+'/'+slug);
    },

    updateProduct(product,id) {
        return ApiConnection().put('/api/products/'+id,product);
    },
    deleteProduct(id) {
        return ApiConnection().delete('/api/products/'+id);
    }
}