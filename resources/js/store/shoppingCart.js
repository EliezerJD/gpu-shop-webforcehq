import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    dataInfo:[],
    cartItems:[],
    items: [
      {
        id:0,
        img: require('../../assets/rtx-3090-500.jpg').default,
        title: 'EVGA RTX 3090',
        price: 3000,
        desc: 'Descripcion corta',
        type: 'RTX'

      },
      {
        id:1,
        img: require('../../assets/Gtx-1660S-500.jpg').default,
        title: 'GTX 1660S',
        price: 500,
        desc: 'Descripcion corta',
        type: 'GTX'
      },
      {
        id:2,
        img: require('../../assets/QUADRO-4000-500.jpg').default,
        title: 'PNY Quadro 4000',
        price: 1000,
        desc: 'Descripcion corta',
        type: 'Quadro'
      },
      {
        id:3,
        img: require('../../assets/rtx-3080-500.jpg').default,
        title: 'ZOTAC RTX 3080',
        price: 2300,
        desc: 'Descripcion corta',
        type: 'RTX'
      },
      {
        id:4,
        img: require('../../assets/QUADRO-8000-500.png').default,
        title: 'NVIDIA Quadro 8000',
        price: 2500,
        desc: 'Descripcion corta',
        type: 'Quadro'
      },
      {
        id:5,
        img: require('../../assets/GTX-1070-500.jpg').default,
        title: 'GIGABYTE GTX 1070',
        price: 500,
        desc: 'Descripcion corta',
        type: 'GTX'
      },
    ]
  },
  // plugins: [createPersistedState()],
  getters: {
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
  },
  mutations: {
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
  },
})
