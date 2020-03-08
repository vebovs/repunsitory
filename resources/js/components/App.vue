<template>
    <div>
        <nav class="navbar navbar-dark bg-dark mb-2">
            <router-link class="navbar-brand" :to="{ name : 'home' }">Repunsitory</router-link>
            <div v-if="!status">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name : 'login' }">Login</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name : 'register' }">Register</router-link>
                    </li>
                </ul>
            </div>
            <div v-if="status">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link v-if="role === 1" class="nav-link" :to="{ name : 'dashboard' }">{{ username }}</router-link>
                        <router-link v-if="role === 2" class="nav-link" :to="{ name : 'admin' }">{{ username }}</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" v-on:click.native="logout" :to="{ name : 'home' }">Logout</router-link>
                    </li>
                </ul>
            </div>
        </nav>
        <div v-if="error" class="container alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ error }}</strong>
            <button v-on:click="clear_error()" type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div v-if="toggle" class="container">
            <div class="card">
                <div class="card-header">
                    Success!
                </div>
                <div class="card-body">
                    <h3>E-mail verification successful</h3>
                    <p>E-mail has been verified. You can now log in to your account</p>
                    <button v-on:click="login" type="button" class="btn btn-primary"> Go to login page</button>
                </div>
            </div>
        </div>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';
import axios from 'axios';

export default {
    data() {
        return {
            toggle: false
        }
    },

    computed: {
        ...mapState([
            'status',
            'username',
            'error',
            'role'
        ])
    },

    async created() {
        console.log(this.$route.query.queryURL);
        if(this.$route.query.queryURL) {
            this.toggle = true;
            await axios.get(this.$route.query.queryURL, {
                withCredentials: true
            })
            .then(response => {
                console.log(response);
            })
            .catch(err => {
                console.log(err.response.data.message);
            });
        }
        this.$store.dispatch('refresh');
    },

    methods: {
        logout() {
            this.$store.dispatch('logout');
        },
        
        clear_error() {
            this.$store.commit('error', '');
        },

        login() {
            this.toggle = false;
            this.$router.push({ name: 'login' });
        }
    }
}
</script>