<template>
  <div class="container-flex">
    <nav class="navbar navbar-light">
      <div class="dropdown d-xl-none d-lg-none mr-auto">
        <img src="" data-toggle="dropdown" data-target="#navd" aria-haspopup="true" aria-expanded="false">
        <div class="dropdown-menu hb" aria-labelledby="navd">
          <router-link class="dropdown-item" to="/">Home</router-link>
          <router-link class="dropdown-item" to="/products">Products</router-link>
        </div>
      </div>
      <!--Logo-->
      <a class="navbar-brand py-0 pl-5">
          <img :src="require('../assets/nvidia-logo.png').default" width="50" height="50">
      </a>
      <!--Header navigation-->
      <span class="navbar-item bc d-none d-xl-block d-lg-block py-0">
        <router-link class="pl-5" to="/">Home</router-link>
        <router-link class="px-5" to="/products">Products</router-link>
      </span>

      <p class="navbar-item ml-auto">
        <div class="bag" @click="openCart">
          <img :src="require('../assets/cart.svg').default" class="pb-1">
            <span class="mb-3" v-if="cartCount >= 0">{{ cartCount }}</span>
        </div>
        <div class="user">
          <h5 v-if="userIsGuest" style="cursor: pointer" data-toggle="modal" data-target="#userModal">Sign In</h5>

          
          <div v-if="userIsLogin" class="dropdown">
            <h5 class="dropdown-toggle user" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{user.name}}</h5>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a v-if="userIsAdmin" class="dropdown-item" @click="manage">Manage</a>
              <a class="dropdown-item" @click="logout">Logout</a>
            </div>
          </div>
        </div>
    </nav>
    <!--User Modal-->
    <div ref="modal" class="modal fade" id="userModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" style="outline-style:none;" aria-label="Close">
              <span>x</span>
            </button>
            <form class="px-3 py-2">
              <div class="form-group">
                <label for="exampleDropdownFormEmail1">Email address</label>
                <input type="email" class="form-control" name="email" placeholder="email@example.com" v-model="email">
              </div>
              <div class="form-group">
                <label for="exampleDropdownFormPassword1">Password</label>
                <input type="password" class="form-control" placeholder="Password" v-model="password">
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input">
                <label class="form-check-label" for="dropdownCheck">
                    Remember me
                  </label>
              </div>
              <button type="button" v-if="userIsGuest" @click="login" class="btn-xl btn-success mt-3">Sign in</button>
            </form>
          </div>
          <div class="modal-footer">
            <a class="dropdown-item" href="#">Forgot password?</a>
            <a class="dropdown-item text-right" href="#">Register</a>
          </div>
        </div>
      </div>
    </div>
    <!--Cart Component-->
    <Cart ref="cartMove" />
    </div>
</template>

<script>
import Cart from '../components/Cart.vue'
import AuthService from '../services/auth';
import CartService from '../services/cart';
import { mapState } from 'vuex'
import { mapGetters } from 'vuex'

export default {
  name: 'Header',
  data(){
    return {
      email:null,
      password:null
    }
  },
  components: {
    Cart
  },
  created() {
    this.getCart;
  },
  computed: {
    cartCount() {
      return this.$store.getters.itemsCount;
    },
    userIsLogin(){
      return this.$store.getters.isLogin;
    },
    user(){
      //console.log("aca")
      return this.$store.getters.getUser;
    },
    userIsAdmin(){
      //console.log(this.$store.getters.isUserAdmin);
      return this.$store.getters.isUserAdmin;
    },
    userIsGuest() {
      return this.$store.getters.isGuest;
    },
    async getCart(){
   
        let haveCart = this.$store.getters.haveCart;
        if (!haveCart) {
          await this.$store.dispatch('createCart');
        }
        
    }
  },
  methods: {
    openCart() {
      this.$refs.cartMove.cartON()
    },
    async login(){
      try {
        let response = await AuthService.login({
          email:this.email,
          password:this.password
        });
        if(response.token){

          this.$store.dispatch('saveToken',{
            token: response.token,
          });
          this.$refs.modal.click();
          this.reloadProfile();
        }
        
      }catch (error) {
        console.log(error);
      }
    },
    manage(){
      this.$router.push({name: 'admin'});
    },
    async logout(){
      try {
        let response = await AuthService.logout();
        this.$store.dispatch('deleteDataUser');
          this.$store.dispatch('clearCart');
          this.$router.push({name: 'default'});
      }catch (error) {
        console.log(error);
      }
    },
    async reloadProfile(){
      await this.$store.dispatch('profile');
    }
  }
}
</script>

<style>
nav {
  z-index:100;
}
.navbar {
  border-bottom: 1px solid #DCDCDC;
  background-color: #F8F8F8;
}

.close {
  position:relative;
  bottom:20px;
  left:10px;
  font-size: 31px;
  color: #000;
}
.navbar-item.bc a {
  font-size: 17px;
  text-decoration: none;
  color: black;
}

.navbar-item.bc a:hover, .navbar-item.bc a:active {
  color: #FFD700;
}
.btn-sm{
  border-radius: 0;
}

form .btn-xl.btn-success.mt-3 {
  position: relative;
  -webkit-transition-duration: 100ms;
  transition-duration: 100ms;
  width: 100%;
  height: 50px;
  font-size: 20px;
  outline:none;
  cursor: pointer;
  box-shadow: 0 26px 38px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.bag{
  margin-right : 15px;
}
.bag span {
    background-color: #6394F8;
    border-radius: 10px;
    color: white;
    position: absolute;
    font-size: 15px;
    line-height: 1;
    padding: 2px 3px 3px 3px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
    margin-left: -9px;
    bottom: 1rem;
}

.bag img {
  cursor: pointer;
  width: 30px;
  height: auto;
}

.user{
  margin-right: 20px;
  padding-top: 10px;
  cursor: pointer;
}

.user:hover {
  text-decoration: underline;
}

</style>
