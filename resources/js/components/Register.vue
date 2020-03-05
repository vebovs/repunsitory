<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        Register
      </div>
      <div class="card-body">
        <form @submit.prevent="register" method="post">
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
          <button type="submit" class="btn btn-primary">Register</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  data() {
    return {
      username: '',
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
    register() {
      this.$store.commit('error', '');
      if(this.username && this.email && this.password) {
        this.$store.dispatch('register', {
          username: this.username,
          email: this.email,
          password: this.password
        })
        .then(() => {
          if(!this.error) {
            this.$router.push({ name: 'login' });
          }
        });
      }
    }
  }
};
</script>