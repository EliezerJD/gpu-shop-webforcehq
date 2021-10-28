<template>

    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>Update Account</h4>
                            <p>{{ user.name }} | {{ user.role }}</p>
                            <router-link :to="{name:'listUsers'}" class="button button-account">Users List</router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner register_form_inner">
                        <h3>Update an account</h3>
                        <form class="row login_form" >
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name"  name="name" placeholder="name" v-model="user.name">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" v-model="user.email" >
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="button" @click="updateAccount" value="submit" class="button button-register w-100"> <i class="fas fa-edit"></i> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>


<script>
import UserService from '../../../services/user';
export default {
    name: "UserEditAdminPage",
    data() {
        return {
            user:{
                id:'',
                email:'',
                fullname:'',
            }
        }
    },
    mounted() {
        this.getUser();
    },
    methods:{
        async getUser() {
            let id = this.$route.params.id;
            let response = await UserService.getUser(id);
            this.user = response.data;
        },
        async updateAccount() {
            try {
                let response = await UserService.updateUser({name:this.user.name,email:this.user.email},this.user.id);
                alert("User updated successfully");
                this.$router.push({ name: 'listUsers'})
            }catch (error) {
                console.log(error);
            }
        }
    }
}
</script>

<style scoped>
</style>