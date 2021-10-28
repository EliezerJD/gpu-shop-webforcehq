
<template>
    <div class="container">
        <div class="row bg">
            <ul class="list">
            <br>
            <h2>Your Order</h2>
            <h4>Product <span>Total</span></h4>
            <div v-for="item in cart.items">
                <h5 >
                    {{ item.name }} ({{ item.amount }})
                    <span class="last">${{ item.subtotal }} USD</span>
                </h5>
            </div>
            </ul>
            <ul class="list list_2">
                <h5>Total <span>${{ cart.total }} USD</span></h5>
                <button @click="pay" type="button" class="btn btn-success">Proceed to checkout</button>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "CartListCardComponent",
    props:{
        cart:{
            type:Object
        }
    },
    methods:{
        pay(){
            alert("We are in maintenance, try again later please");
        }
    }
}
</script>

<style scoped>
.bg{
    background-color: rgba(132, 132, 132, 0.7);
    border-radius: 25px;
}
</style>