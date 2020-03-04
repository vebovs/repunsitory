<template>
    <div class="container">
        <div class="text-center mt-2">
            <h3>Administration</h3>
        </div>
        <div class="text-center">
            <div class="btn-group btn-group-lg mt-2" role="group" aria-label="Basic example">
                <button v-on:click="toggle = false" type="button" class="btn btn-secondary">Users</button>
                <button v-on:click="toggle = true" type="button" class="btn btn-secondary border-left">Puns</button>
            </div>
        </div>
        <div v-if="!toggle">
            <div class="card card-body m-4" v-for="user in users" v-bind:key="user.id">
                <h4>Username: {{ user.username }}</h4>
                <h4>E-mail: {{ user.email }}</h4>
                <h4>User ID: {{ user.id }}</h4>
                <button v-on:click="removeUser(user.id)" type="button" class="btn btn-primary btn-danger">Delete</button>
            </div>
        </div>
        <div v-if="toggle">
            <div class="card card-body m-4" v-for="pun in home" v-bind:key="pun.id">
                <h3>{{ pun.title }}</h3>
                <p>{{ pun.body }}</p>
                <p>User ID: {{ pun.user_id }}</p>
                <button v-on:click="removePun(pun.id)" type="button" class="btn btn-primary btn-danger">Delete</button>
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

        removePun(id) {
            this.$store.dispatch('delete_pun', {
                id: id
            });
        }
    }
}
</script>