<template>
    <section class="checkout_area section-margin--small">
        <br>
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Billing Details</h3>
                        <form class="row">
                            <div class="col-md-6 form-group p_star">
                                <label for="">Name</label>
                                <input type="text" class="form-control" v-model="name" name="name">
                                <span class="placeholder" data-placeholder="First name"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <label for="">Last Name</label>
                                <input type="text" class="form-control" v-model="last_name" name="holder_name">
                                <span class="placeholder" data-placeholder="First name"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <label for="">Email</label>
                                <input type="text" class="form-control" id="last" v-model="email" name="phone">
                                <span class="placeholder" data-placeholder="Last name"></span>
                            </div>


                            <div class="col-md-12 form-group p_star">
                                <label for="">Card Number</label>
                                <input type="text" class="form-control" v-model="card_number" name="card_number">
                                <span class="placeholder" data-placeholder="Address line 01"></span>
                            </div>
                            <div class="col-md-4 form-group p_star">
                                <label for="">Expiration Year</label>
                                <select name="expiration_year" v-model="expiration_year" id="" class="form-control">
                                    <option :value="year.value" v-for="year in items_year"> {{ year.text }} </option>
                                </select>
                                <span class="placeholder" data-placeholder="Address line 01"></span>
                            </div>
                            <div class="col-md-4 form-group p_star">
                                <label for="">Expiration Month</label>
                                <select name="expiration_year" v-model="expiration_month" class="form-control" >
                                    <option value="" selected>Expiration Month</option>
                                    <option :value="month.value" v-for="month in items_months"> {{ month.text }} </option>
                                </select>
                                <span class="placeholder" data-placeholder="Address line 01"></span>
                            </div>
                            <div class="col-md-4 form-group p_star">
                                <label for="">CVV</label>
                                <input type="text" class="form-control" v-model="cvv2" name="cvv">
                                <span class="placeholder" data-placeholder="Address line 02"></span>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="">Address</label>
                                <textarea name="address" class="form-control" v-model="address.address" cols="30" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <label for="">Country</label>
                                <input type="text" class="form-control" v-model="address.country" name="country">
                                <span class="placeholder" data-placeholder="Phone number"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <label for="">State</label>
                                <input type="text" class="form-control" v-model="address.state" name="state">
                                <span class="placeholder" data-placeholder="Email Address"></span>
                            </div>

                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <br>
                            <br>
                            <br>
                            <CardCheckout :cart="cart"></CardCheckout>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import CartService from "../services/cart";
import CardCheckout from "../components/CheckoutPage/CardCheckout";
export default {
    name: "CheckoutPage",
    components:{
        CardCheckout
    },
    data() {
        return {
            cartId: this.$store.getters.getCartId,
            cart : {},
            name:'',
            last_name:'',
            email:"",
            address:{
                address:'',
                state:'',
                country:''
            },
            card_number:"5598238754128462",
            expiration_year:"28",
            expiration_month:"05",
            cvv2:"777",
            items_months: [
                { text: "01 - Jan", value: "01" },
                { text: "02 - Feb", value: "02" },
                { text: "03 - Mar", value: "03" },
                { text: "04 - Apr", value: "04" },
                { text: "05 - May", value: "05" },
                { text: "06 - Jun", value: "06" },
                { text: "07 - Jul", value: "07" },
                { text: "08 - Aug", value: "08" },
                { text: "09 - Sept", value: "09" },
                { text: "10 - Oct", value: "10" },
                { text: "11 - Nov", value: "11" },
                { text: "12 - Dec", value: "12" },
            ],
            items_year: [
                { text: "2021", value: "21" },
                { text: "2022", value: "22" },
                { text: "2023", value: "23" },
                { text: "2024", value: "24" },
                { text: "2025 ", value: "25" },
                { text: "2026", value: "26" },
                { text: "2027", value: "27" },
                { text: "2028", value: "28" },
                { text: "2029", value: "29" },
                { text: "2030", value: "30" },
            ],
        }
    },
    mounted() {
        this.getCart();
    },
    methods:{
        // convert in a component cartCardCheckout
        getCart() {
            CartService.getCart(this.cartId).then((response)=>{
                this.cart = response.data;
            }).catch((error)=>{
                console.log(error);
            });
        },
        
        checkout(response) {
            //build payment
            this.payload.customer = {
                name:this.name,
                last_name:this.last_name,
                email:this.email
            };
            this.payment.token    = response.data.id;
            this.payload.address  = this.address;
            this.payload.payment  = this.payment;
            CartService.checkout(this.cartId,this.payload)
                .then(response=>{
                    this.loading.hide();
                    this.$toast.open({
                        message:'Order successfully created',
                        position:'top-right',
                        type: 'success',
                        // all of other options may go here
                    });
                    this.$store.dispatch('cart/clearCart');
                    this.$router.push({name:'order',params:{order_key:response.order_key}});
                })
                .catch(error =>{
                    console.log(error);
                    this.$toast.open({
                        message:error.description,
                        position:'top-right',
                        type: 'warning',
                        // all of other options may go here
                    });
                    this.loading.hide();
                });
        },
    }
}
</script>

<style scoped>
</style>