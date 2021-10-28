<template >
  <div class="container py-5" style="padding-top:70px;">

    <Title :information="information"/>
    <ProductDetails :information="information"/>
    <div class="related-item">
      <hr>
      <h6 class="pb-4">RELATED PRODUCTS</h6>
      
    </div>

  </div>
</template>

<script>
import Title from '../components/InfoPage/Title.vue'
import ProductDetails from '../components/InfoPage/ProductDetails.vue'
import MoreProducts from '../components/ProductsPage/Card.vue'
import ProductService from "../services/product";


export default {
  name:'Info',
  components: {
    Title, ProductDetails, MoreProducts
  },
  data() {
    return {
      information: [],
      relatedItems: []
    }
  },
    created(){
      this.getOne();
    
    },
  computed: {
    info() {
      return this.$store.getters.infoLength
    },
  },
  methods: {
    getOne(){
      var split = this.$router.currentRoute.path.split('/');
      ProductService.getProduct(split[2]).then((response) => {
        this.information =  response.data;
      }).catch((error => {
        console.log(error)
      }));
    }
  }
}
</script>

<style scoped>
hr {
width: 50px;
border-bottom: 1px solid black;
}
.related-item{
  padding-left: 8rem;
  padding-right: 8rem;
  height: auto;
  text-align: center;
}
</style>
