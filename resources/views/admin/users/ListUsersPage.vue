<template>
    <section class="cart_area">
        <div class="container">
            <div class="row d-flex justify-content-between align-items-center" >
                <h4>Users Management</h4>
            </div>
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody v-for="user in users">
                        <tr>
                            <td>
                                {{ user.name }}
                            </td>
                            <td>
                                <h5> {{ user.email }} </h5>
                            </td>
                            <td class="text-uppercase">
                                <span  :class="[user.role == 'admin' ? 'bg-info' : 'bg-secondary', 'badge','text-white']">{{ user.role }}</span>
                            </td>
                            <td>
                                <router-link :to="{name:'editUsers', params:{id:user.id}}" class="btn btn-sm btn-primary"><i class="fa fa-edit">Edit</i></router-link>
                                <a href="#" class="btn btn-sm btn-danger" @click.prevent="userDelete(user.id)"><i class="fas fa-trash">Delete</i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
</template>

<script>
import UserService from '../../../services/user';
import ProductService from "../../../services/product";
export default {
    name: "UserListAdminPage",
    data() {
        return {
            users:{},
        }
    },
    mounted() {
        this.getUsers();
    },
    methods:{
        getUsers() {
            UserService.getUsers().then((response)=>{
                this.users = response.data.data;
            }).catch((error)=>{
                console.log(error)
            });
        },
        async userDelete(userId) {
            if (window.confirm("Do you really want to delete this user?")) {
                UserService.deleteUser(userId).then((response) => {
                    this.getUsers();
                }).catch((error => {
                    console.log(error);
                }));
            }
            
        }
    }
}
</script>

<style scoped>
</style>