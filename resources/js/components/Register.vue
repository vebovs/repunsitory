<template>
    <div>
        <div>
            <form class="m-4" @submit.prevent="register" v-if="!success" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input v-model="username" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control">
                </div>
                <button v-on:click="register" type="submit" class="btn btn-primary mt-2">Register</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            username: '',
            email: '',
            password: '',
            error: false,
            errors: {},
            success: false
        }
    },
    methods: {
        register() {
            var app = this
                this.$auth.register({
                    data: {
                        username: app.username,
                        email: app.email,
                        password: app.password
                    }, 
                    success: function () {
                        app.success = true
                    },
                    error: function (resp) {
                        app.error = true;
                        app.errors = resp.response.data.errors;
                    },
                    redirect: null
                });    
        }
    }
}
</script>