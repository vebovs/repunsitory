<template>
  <div class="container">
    <form class="m-4" @submit.prevent="register" method="post">
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
</template>

<script>
export default {
  data() {
    return {
      username: '',
      email: '',
      password: ''
    };
  },

  methods: {
    register() {
      if(this.username && this.email && this.password) {
        this.$store.dispatch('register', {
          username: this.username,
          email: this.email,
          password: this.password
        })
        .then(() => {
          this.$router.push({ name: 'login' });
        });
      }
    }
  }
};
</script>