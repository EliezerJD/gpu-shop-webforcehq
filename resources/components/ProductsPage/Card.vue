<template>
  <div>
    <transition-group name="fade" class="row" tag="div">
      <div v-for="item in CardArray" class="col-6 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-4 pb-3" :key="item.id">
          <div class="card">
            
            <img :src=item.image alt="Card image cap">
            
            <div class="overlay">
              <button type="button" class="btn btn-outline-secondary btn-lg" @click="addtoCart(item.id)">Add to cart</button>
              <router-link :to="{name:'info',params:{arg:item.slug}}"><button type="button" class="btn btn-outline-secondary btn-lg">Info</button></router-link>
            </div>
            <div class="card-body">
              <br>
              <h5 class="card-title">{{ item.name }}</h5>
              <p class="card-text">${{ item.price }} USD</p>
            </div>
          </div>
      </div>
    </transition-group>
  </div>

</template>

<script>

import CartService from "../../services/cart";
export default {
  props: ['CardArray'],
  name: 'Card',
  data(){
    return {
    }
  },
  methods: {
    addtoCart(id) {
      let cartId = this.$store.getters.getCartId;
      console.log(cartId, id)
      CartService.addItem(cartId,{item_id:id}).then((response)=>{
        alert("Producto agregado correntamente");
        this.$store.dispatch('incrementCart',1);
      }).catch((error)=>{
        console.log(error);
      });
    },
  }
}
</script>

<style>
/* transition Group style */
.fade-move {
  transition: transform 1s;
}
/* Card Style */
.card {
  transition: 500ms;
  position: relative;
  overflow: hidden;
}

.card img {
  z-index: 1;
}

.card button {
  width: 140px;
  margin-bottom: 10px;
}

.card:hover img {
  filter: blur(4px);
}

.card:hover .overlay {
  opacity: 0.8;

}

.card .overlay {
  position: absolute;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 70%;
  background-color: #232b34;
  opacity: 0;
  z-index: 100;
  transition: all 0.3s ease-in;
}

.card:hover, .card:active {
  transform: scaleY(1.1) scaleX(1.06);
  box-shadow: 0 14px 98px rgba(0, 0, 0, 0.25), 0 0px 60px rgba(0, 0, 0, 0.22);
}
</style>
