<template>
  <div>
    <div :class="cClass">
      <div class="cart-menu">
        <h1 class="text-center">Cart</h1>
        <hr>

        <transition name="fade">
          <div v-if="cartCount === 0" class="text-center font-italic">
            Your cart is empty, try to add products.
          </div>
        </transition>

        <transition-group name="fade">
          <div class="row" v-for="item in this.cart.items" v-bind:key="item.id">
            <div class="col4 col-xl-4 col-lg-4 col-md-4 col-sm-4">
              <img :src="item.image" style="width: 90px;">
            </div>
            <div class="col6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
              <h4>{{ item.name }}</h4>
              <h6>Amount: {{ item.amount }}</h6>
              <h5>${{ item.price }} USD</h5>
            </div>
            <div class="col2 col-xl-2 col-lg-2 col-md-2 col-sm-2 pt-4">
              <span class="remove-btn" @click="deleteItem(item)">remove</span>
            </div>
          </div>
        </transition-group >

       
        <hr>
        <div class="row justify-content-between" style="background:#7dcf85;padding:10px 10px 10px 10px" v-if="cartCount > 0">
          <div class="flex-column pl-3">
            <h4>Total</h4>
          </div>
          <div class="flex-column pr-3">
            <h4>${{ this.cart.total }} USD</h4>
          </div>
          <br>
          
        </div>
        <div class="container">
          <div class="row justify-content-center">
          <div class="col-md-4">
            <button  @click="checkout()" type="button" class="btn btn-info">Checkout</button>
          </div>
        </div>
        </div>
        
        
      </div>
    </div>

    <div :class="modalClass" @click="cartON"></div>
  </div>
</template>

<script>
import CartService from '../services/cart';

export default {
  name: 'Cart',
  data() {
    return {
      cClass: 'cart',
      modalClass: 'modal off',
      cartId: this.$store.getters.getCartId,
      cart : {}
    }
  },
  computed:{
    cartCount() {
      return this.$store.getters.itemsCount;
    },
  },
  methods: {
    cartON() {
      if(this.cClass === 'cart on'){
        this.cClass = 'cart'
        this.modalClass = 'modal off'
      }else{
        this.cClass = 'cart on'
        this.modalClass = 'modal'
        this.getCart();
      }
    },
    getCart() {
      CartService.getCart(this.cartId).then((response)=>{
        this.cart = response.data;
      }).catch((error)=>{
        console.log(error);
      });
    },
    deleteItem(item) {
      let cartId = this.$store.getters.getCartId;
      CartService.removeItem(cartId, item).then(response=>{
        this.$store.dispatch('decrementCart',item.amount);
        this.getCart();
      }).catch(error => {
        console.log(error);
      });
    },
    checkout(){
      this.$router.push({name: 'checkout'});
      this.cClass = 'cart'
      this.modalClass = 'modal off'
    }
  }
}
</script>

<style scoped>
/* Modal Overlay */
.modal {
  display: block;
  z-index: 1050;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
.modal.off {
  display: none;
}
/* Transitions */
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to{
  opacity: 0;
}
/* Cart Body */
.cart {
  position: fixed;
  margin-right: 0px;
  top: 0;
  right: 0;
  width: 360px;
  height: 100%;
  background: #303e49;
  overflow-y: auto;
  z-index:1051;
  -webkit-overflow-scrolling: touch;
  transform: translateX(360px);
  transition-property: transform;
  transition-duration: 0.4s;
}
.cart.on{
  transform: translateX(0);
  -webkit-overflow-scrolling: touch;
  transition-property: transform;
  transition-duration: 0.4s;
}

.cart-menu{
  color: #eee;
  margin-left: 10px;
  margin-right: 15px;
}

hr {
border-color: white;
}

.row{
  margin-top: 10px;
  margin-bottom: 10px;
}


.remove-btn{
  border-radius: 50%;
  content: url('../assets/multiply.png')
}

.remove-btn:hover {
  background-color: grey;
}

</style>
