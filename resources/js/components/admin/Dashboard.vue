<template>
    <div>
        <div style="background-color: #343a40">
            <nav class="navbar navbar-expand navbar-dark bg-dark container">
                 <ul class="navbar-nav">
                    <li class="nav-item">
                        <a v-on:click="toggle = false" class="nav-link pl-0" href="#">Users</a>
                    </li>
                    <li class="nav-item">
                        <a v-on:click="toggle = true" class="nav-link" href="#">Puns</a>
                    </li>
                </ul>
         </nav>
        </div>
        <div class="container">
            <div v-if="!toggle">
                <div class="card card-body mt-2" v-for="user in users" v-bind:key="user.id">
                    <h4>Username: {{ user.username }}</h4>
                    <h4>E-mail: {{ user.email }}</h4>
                    <button v-on:click="removeUser(user.id)" type="button" class="btn btn-primary btn-danger m-1">Delete</button>
                    <button v-on:click="banUser(user.id)" type="button" class="btn btn-primary btn-danger m-1">Ban</button>
                </div>
            </div>
         <div v-if="toggle">
            <div class="card mt-2" v-for="pun in home" v-bind:key="pun.id">
                <div class="card-header">
                    Created by {{ pun.username }}
                </div>
                <div class="card card-body">
                    <h3>{{ pun.title }}</h3>
                    <p>{{ pun.body }}</p>
                    <button v-on:click="removePun(pun.id)" type="button" class="btn btn-primary btn-danger">Delete</button>
                </div>
            </div>
         </div>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
    data() {
        return {
            toggle: false
        }
    },

    computed: {
        ...mapState([
            'users',
            'home'
        ])
    },

    created() {
        this.$store.dispatch('users');
        this.$store.dispatch('home', {
                page_url: 'api/recent'
            });
    },

    methods: {
        removeUser(id) {
            this.$store.dispatch('delete_user', {
                id: id
            });
        },

        banUser(id) {
            this.$store.dispatch('ban_user', {
                id: id
            });
        },

        removePun(id) {
            this.$store.dispatch('delete_pun', {
                id: id
            });
        }
    }
}
</script>