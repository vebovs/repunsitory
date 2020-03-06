<template>
  <div class="container">
    <div class="card">
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
</template>

<script>
import { mapState } from 'vuex';

export default {
  data() {
    return {
      email: 'karu@karu.com',
      password: 'passord'
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
            this.$store.dispatch('show');
          }
        })
        .then(() => {
          if(!this.error) {
            this.$router.push({ name: 'home' });
          }
        });
      }
    }
  }
};
</script>
