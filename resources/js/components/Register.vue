<template>
    <div>
        <div>
            <form v-on:submit="register" class="m-4" @submit.prevent="register" v-if="!success" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input v-model="username" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input v-model="email" type="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input v-model="password" type="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Register</button>
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
            // why does it fire twice
            console.log("firing");
            var app = this;
                /*this.$auth.register({
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
                });*/  

                fetch('api/auth/register', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        email: app.email,
                        username: app.username,
                        password: app.password

                    })
                })
                .then(res => res.json())
                .then(data => console.log(data))
                .catch(err => console.error(err));
        }
    }
}
</script>