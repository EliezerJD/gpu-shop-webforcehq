import CartService from '../../../services/cart';

  const state = {
    dataInfo:[],
    cartItems:[],
    products:[],
    counter: localStorage.getItem('cart_count') || 0,
    cartId: localStorage.getItem('cart_id') || null,
  };

  const getters = {
    products(){
      return state.products.products;
    },

    haveCart(state){
      if(state.cartId==null){
        return state.cardId;
      }else{
        return state.cardId !==null;
      }
    },
    itemsCount(state) {
        return state.counter;
    },
    getCartId(state){
      return state.cartId;
    },
    totalPrice(state) { // Cart Component
      if (state.cartItems.length != 0){
       return state.cartItems.reduce((a, b) => {
         return (b.price == null ) ? a : a + b.price
       }, 0)
      }
    },
    infoLength(state) { // Info Component
      if(state.dataInfo.length > 0) {
        return state.dataInfo.splice(0, 1)
      }
    }
  };
  const mutations={

    setProducts(state, products){
      //console.log(products)
      state.products = products;

    },
    incrementCountCart(state, amount) {
      state.counter = parseInt(state.counter) + parseInt(amount);
      localStorage.setItem('cart_count', state.counter);
    },
    outCart(state, n) { // Cart Component
      let index = state.cartItems.findIndex(x => x.id === n)
      return state.cartItems.splice(index, 1)
    },
    decrementCountCart(state, amount) {
        state.counter = parseInt( state.counter ) - parseInt(amount);
        localStorage.setItem('cart_count',state.counter);
    },
    setCartId(state,cartId) {
        state.cartId = cartId;
        localStorage.setItem('cart_id', cartId);
    },
    clearCounter(state) {
        state.counter = 0;
        state.cartId = null;
        localStorage.setItem('cart_count','0');
        localStorage.removeItem('cart_id',null);
    }
  };

  const actions = {
    saveProducts(context, products){
        context.commit('setProducts', products);
    },
    createCart(context) {
      return new Promise((resolve , reject)=>{
        CartService.storeCart().then((response)=>{
          const cartId = response.id;
          context.commit('setCartId',cartId);
          resolve(response);
        }).catch((error)=>{
          reject(error);
        })
      });
    },
    incrementCart(context, amount) {
        context.commit('incrementCountCart', amount);
    },
    decrementCart(context, amount) {
      context.commit('decrementCountCart', amount);
    },
    clearCart(context) {
        context.commit('clearCounter');
        context.dispatch('createCart').then(response=>{
          console.log("ok")
        }).catch(error=>{
            console.log(error);
        });
    }
  };
  export default {
    namespace: true,
    state,
    getters,
    mutations,
    actions
}
