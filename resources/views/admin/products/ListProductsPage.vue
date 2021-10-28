<template>
    <section class="cart_area">
        <div class="container">
            <div class="row d-flex justify-content-between align-items-center" >
                <h4>Products Management</h4>
                <router-link :to="{name:'adminproductcreate'}" class="btn btn-sm btn-primary"> <i class="fas fa-plus-circle"></i> Add Product</router-link>
            </div>
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody v-for="product in products">
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img style="width: 85px" :src="'../'+product.image" alt="">
                                        </div>
                                        <div class="media-body">
                                            <p>{{ product.name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>${{ product.price }} USD</h5>
                                </td>
                                <td>
                                    <router-link :to="{name:'editProducts',params:{'product_id':product.id,'slug':product.slug} }" class="btn btn-sm btn-primary">Edit<i class="fa fa-edit"></i></router-link>
                                    <a href="#" class="btn btn-sm btn-danger" @click.prevent="productDelete(product.id)">Delete<i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li @click.prevent="getPreviousPage" :class="[ ! paginate.prev ? 'disabled' : '']"   class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item" @click.prevent="getPage(page)"  v-if="paginate.last_page != 1"  :class="[paginate.current_page == page ? 'active' : '']" v-for="page in paginate.last_page">
                                <a class="page-link" href="#">{{ page }}</a>
                            </li>
                            <li @click.prevent="getNextPage" :class="[ ! paginate.next ? 'disabled' : '']"  class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>


</template>

<script>
import ProductService from "../../../services/product";
export default {
    name: "ProductListAdminPage",
    data(){
        return {
            products:{},
            paginate:{
                prev:false,
                next:false,
                last_page:0,
                current_page:1
            },
            fullPage: false
        }
    },
    mounted() {
        this.getPageOne();
    },
    methods: {
        productDelete(id) {
            if (window.confirm("Do you really want to delete this user?")) {
                ProductService.deleteProduct(id).then((response) => {
                    this.getPage(this.paginate.current_page);       
                }).catch((error => {
                    console.log(error);
                }));
            }
            
        },
        getPageOne() {
            this.getProducts(this.paginate.current_page);
        },
        getPage(page) {
            this.setCurrentPage(page);
            this.getProducts();
        },
        getPreviousPage() {
            let page = this.paginate.prev.split('?page=');
            this.setCurrentPage(page[1]);
            this.getPage(page[1]);
        },
        getNextPage() {
            let page = this.paginate.next.split('?page=');
            this.setCurrentPage(page[1]);
            this.getPage(page[1]);
        },
        getProducts() {
            ProductService.getProductsPage(this.paginate.current_page).then((response) => {
                this.paginate.prev = response.data.links.prev;
                this.paginate.next = response.data.links.next;
                this.paginate.last_page = response.data.meta.last_page;
                this.paginate.current_page = response.data.meta.current_page;
                this.products = response.data.data;
            }).catch((error => {
                loader.hide();
            }));
        },
        setCurrentPage(page) {
            this.paginate.current_page = page;
        }
    }
}
</script>

<style scoped>
</style>