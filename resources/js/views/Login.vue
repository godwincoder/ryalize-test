<!-- Login Template -->
<template>
  <h2 class="mt-5">Login</h2>
  <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
  <div class="container d-flex align-items-center justify-content-center">
    <div class="w-100" style="max-width: 400px;">
      <form @submit.prevent="handleLogin" class="mt-3">
          <div class="mb-3">
              <label for="email" class="form-label">Email:</label>
              <input
                  type="email"
                  class="form-control"
                  id="email"
                  v-model="email"
                  required
              />
              <div v-if="errors.email" class="text-danger">{{ errors.email }}</div>
          </div>
          <div class="mb-3">
              <label for="password" class="form-label">Password:</label>
              <input
                  type="password"
                  class="form-control"
                  id="password"
                  v-model="password"
                  required
              />
              <div v-if="errors.password" class="text-danger">{{ errors.password }}</div>
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
          <p v-if="loginError" class="text-danger mt-3">{{ loginError }}</p>
      </form>
      </div>
  </div>
</template>
  
  <script>

  import Platform from 'platform';
  import { mapActions } from 'vuex';
  
  export default {
    data() {
      return {
        email: '',
        password: '',
        errors: {},
        loginError: '',
        successMessage : ''
      };
    },
    methods: {
      ...mapActions('auth', ['login']),
        async handleLogin() {
            this.errors = {}; // Reset errors
            this.loginError = ''; // Reset login error
            try {
                const info = Platform.parse(navigator.userAgent);
                await this.login({ email: this.email, password: this.password , device_name : info.name + ' ' + info.version + ' ' + info.os + ' ' + info.platform});
              
                // Handle successful login
                // Redirect or perform additional actions here
                this.successMessage = 'User logedIn successfully';
                this.$router.push({ name: 'dashboard' }); 
            } catch (error) {
             // console.log(error.response);
                if (error.response) {
                    if (error.response.status === 422) {
                        // Handle validation errors
                        this.errors = error.response.data.errors;
                    } else {
                        // Handle unauthorized error
                        this.loginError = 'Invalid credentials. Please try again.';
                    }
                } else {
                    this.loginError = 'An error occurred. Please try again later.';
                }
            }
        },
    },
  };
  </script>
  
  <style scoped>
  /* Add your styles here */
  </style>
  