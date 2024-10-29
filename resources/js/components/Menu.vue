<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
            <router-link :to="`${baseUrl}list-user`" class="nav-link">List User</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="`${baseUrl}register-user`" class="nav-link">Add User</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="`${baseUrl}transaction`" class="nav-link">Transaction</router-link>
        </li>
        <li class="nav-item"  v-if="!isAuthenticated">
            <router-link :to="`${baseUrl}login`" class="nav-link">Login</router-link>
        </li>
        <li v-if="isAuthenticated">
            
            <button @click="handleLogout">Logout</button>
        </li>
      </ul>
    </div>
  </div>
</nav>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  computed: {
    baseUrl() {
        return import.meta.env.BASE_URL; // Access the env variable
    },
    ...mapGetters('auth', ['isAuthenticated']),
  },
  name: 'Menu',
  methods: {
    ...mapActions('auth', ['logout']),
    handleLogout() {
      this.logout();
      this.$router.push({ name: 'login' }); // Redirect after logout
    },
  },
};
</script>