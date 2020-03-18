<template>
<div>
  <div>
      <nav class="navbar navbar-expand navbar-dark bg-dark"></nav>
    </div>
  <div class="container">
    <div class="card mt-2">
      <div class="card-header">
        Login
      </div>
      <div class="card-body">
        <form @submit.prevent="login" method="post">
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
    </div>
  </div>
</div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  data() {
    return {
      email: '',
      password: ''
    };
  },

  computed: {
        ...mapState([
            'error'
        ])
    },

  methods: {
    login() {
      this.$store.commit('error', '');
      if(this.email && this.password) {
        this.$store.dispatch('login', {
          email: this.email,
          password: this.password
        })
        .then(() => {
          if(!this.error) {
            this.$store.dispatch('liked')
            this.$router.push({ name: 'home' });
          }
        });
      }
    }
  }
};
</script>
