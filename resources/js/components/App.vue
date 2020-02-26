<template>
    <div>
        <nav class="navbar navbar-dark bg-dark mb-2">
            <router-link class="navbar-brand" :to="{ name : 'home' }">Repunsitory</router-link>
            <div v-if="!currentUser">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name : 'login' }">Login</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name : 'register' }">Register</router-link>
                    </li>
                </ul>
            </div>
            <div v-if="currentUser">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href @click.prevent="logOut">LogOut</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
    currentUser() {
      return this.$store.state.auth.user;
    },
    showAdminBoard() {
      if (this.currentUser && this.currentUser.roles) {
        return this.currentUser.roles.includes('ROLE_ADMIN');
      }
      return false;
    },
    showModeratorBoard() {
      if (this.currentUser && this.currentUser.roles) {
        return this.currentUser.roles.includes('ROLE_MODERATOR');
      }
      return false;
    }
  },
  methods: {
    logOut() {
      this.$store.dispatch('auth/logout');
      this.$router.push({ name: 'home' });
    }
  }
}
</script>