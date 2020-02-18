<template>
    <div>
        <form class="m-4" @submit.prevent="login">
            <div class="form-group">
                    <label for="email">E-mail</label>
                    <input v-model="email" type="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input v-model="password" type="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Login</button>
        </form>
    </div>
</template>

<script>
export default {
    data(){
      return {
        email: null,
        password: null,
        error: false
      }
    },
    methods: {
      login(){
        var app = this;
        this.$auth.login({
            params: {
              email: app.email,
              password: app.password
            }, 
            success: function () {},
            error: function (err) {
                console.log(err);
            },
            rememberMe: true,
            redirect: null,
            fetchUser: true
        });
        
        /*fetch('api/auth/login', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        email: app.email,
                        password: app.password
                    })
                })
                .then(res => res.json())
                .then(data => console.log(data))
                .catch(err => console.error(err));*/
      },
    }
}
</script>
