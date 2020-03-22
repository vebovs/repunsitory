<template>
<div>
  <div>
    <nav class="navbar navbar-expand navbar-dark bg-dark"></nav>
  </div>
  <div class="container">
    <div class="card mt-2">
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
          <div>
            <div v-if="toggle" class="float-left">
              <button type="submit" class="btn btn-primary">Register</button>
            </div>
            <div v-if="!toggle" class="float-left">
              <button class="btn btn-primary" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              </button>
            </div>
          </div>
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
      username: '',
      email: '',
      password: '',
      toggle: true
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
      this.toggle = false;
      if(this.username && this.email && this.password) {
        this.$store.dispatch('register', {
          username: this.username,
          email: this.email,
          password: this.password
        })
        .then(() => {
          if(!this.error) {
            this.$router.push({ name: 'login' });
          } else {
            this.toggle = true;
          }
        });
      }
    }
  }
};
</script>