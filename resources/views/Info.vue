<template >
  <div class="container py-5" style="padding-top:70px;">

    <Title :information="information"/>
    <ProductDetails :information="information"/>
    <div class="related-item">
      <hr>
      <h6 class="pb-4">RELATED PRODUCTS</h6>
      <MoreProducts :CardArray="sliceRelatedItems" />
    </div>

  </div>
</template>

<script>
import Title from '../components/InfoPage/Title.vue'
import ProductDetails from '../components/InfoPage/ProductDetails.vue'
import MoreProducts from '../components/ProductsPage/Card.vue'


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
    this.information = this.info

    if(this.information!= null){
      this.relatedItems = this.bringItems
    }else{
      console.log('retornar a productos')
    }
    
    },
  computed: {
    info() {
      return this.$store.getters.infoLength
    },
    bringItems() {
      return this.$store.state.items
    },
    sliceRelatedItems(){
      return this.relatedItems.slice(0 ,3)
    }
  },
  methods: {
    sendInfo(it, id) {
     this.$store.commit('addtoInfo', it, id)
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
