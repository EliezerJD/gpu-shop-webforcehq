<template>
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-header">
                        <i class="fas fa-shopping-basket" style="font-size:80px; color:#03244D;"></i>
                    </div>
                    <div class="card-body ">
                        <h4 class="card-title">Products</h4>
                        <p class="text-uppercase">Products Management </p>
                        <router-link :to="{name:'listProducts'}" class="btn btn-secondary btn-block">View</router-link>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-header">
                        <i class="fas fa-user" style="font-size:80px; color:#03244D;"></i>
                    </div>
                    <div class="card-body ">
                        <h4 class="card-title">Users</h4>
                        <p class="text-uppercase">Users Management </p>
                        <router-link :to="{name:'listUsers'}" class="btn btn-secondary btn-block">View</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Admin"
}
</script>

<style scoped>
</style>