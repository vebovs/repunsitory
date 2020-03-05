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
                        <router-link class="nav-link" :to="{ name : 'dashboard' }">{{ username }}</router-link>
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
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
    data() {
        return {
            
        }
    },

    computed: {
        ...mapState([
            'status',
            'username',
            'error'
        ])
    },

    methods: {
        logout() {
            this.$store.dispatch('logout');
        },
        
        clear_error() {
            this.$store.commit('error', '');
        }
    }
}
</script>