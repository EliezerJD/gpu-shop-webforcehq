

  const state = {
    dataInfo:[],
    cartItems:[]
  };

  const getters = {
    itemsNumber(state){  // Cart Component
      return state.cartItems.length
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
    inCart(state, n) { // Cart Component
      return state.cartItems.push(n)
    },
    outCart(state, n) { // Cart Component
      let index = state.cartItems.findIndex(x => x.id === n)
      return state.cartItems.splice(index, 1)
    },
    addtoInfo(state, n) { // Info Component
       return state.dataInfo.push(n)
    }
  };
  export default {
    namespace: true,
    state,
    getters,
    mutations
}
