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
  data() {
    return {
      email: '',
      password: ''
    };
  },

  methods: {
    login() {
      if(this.email && this.password) {
        this.$store.dispatch('login', {
          email: this.email,
          password: this.password
        })
        .then(() => {
          this.$router.push({ name: 'dashboard' });
        });
      }
    }
  }
};
</script>
