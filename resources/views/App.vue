<template>
    <div>
        <Header></Header>
        <main>
            <router-view></router-view>
        </main>
        <Footer></Footer>
    </div>
</template>

<script>
import Header from "../components/Header";
import Footer from "../components/Footer";
    export default {
        components:{
            Header,
            Footer
        },
    }
</script>
