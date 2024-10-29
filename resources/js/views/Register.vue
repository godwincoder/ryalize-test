<!-- Register template -->
<template>
    <div class="container h-100 d-flex align-items-center justify-content-center">
      <div class="w-100" style="max-width: 400px;">
        <h2 class="text-center mb-4">Add User</h2>
        <form @submit.prevent="handleSubmit">
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input
              type="text"
              class="form-control"
              id="name"
              v-model="name"
              required
              @input="validateName"
            />
            <div v-if="nameError" class="text-danger">{{ nameError }}</div>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input
              type="email"
              class="form-control"
              id="email"
              v-model="email"
              required
              @input="validateEmail"
            />
            <div v-if="emailError" class="text-danger">{{ emailError }}</div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
              type="password"
              class="form-control"
              id="password"
              v-model="password"
              required
              @input="validatePassword"
            />
            <div v-if="passwordError" class="text-danger">{{ passwordError }}</div>
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input
              type="password"
              class="form-control"
              id="confirmPassword"
              v-model="confirmPassword"
              @input="validatePassword"
              required
            />
            <div v-if="confirmPasswordError" class="text-danger">{{ confirmPasswordError }}</div>
          </div>
          <button type="submit" class="btn btn-primary w-100">Register</button>
          <div v-if="errorMessage" class="mt-3 text-danger">{{ errorMessage }}</div>
          <div v-if="successMessage" class="mt-3 text-success">{{ successMessage }}</div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
        confirmPassword: '',
        nameError: '',
        emailError: '',
        passwordError: '',
        confirmPasswordError: '',
        errorMessage: '',
        successMessage: '',
      };
    },
    methods: {
      validateName() {
        this.nameError = this.name ? '' : 'Name is required.';
      },
      validateEmail() {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        this.emailError = this.email && emailPattern.test(this.email) ? '' : 'Valid email is required.';
      },
      validatePassword() {
        
        this.passwordError = this.password.length >= 6 ? '' : 'Password must be at least 6 characters long.';
        this.confirmPasswordError = this.password == this.confirmPassword ? '' : 'Passwords do not match.';
      },
      async handleSubmit() {
        this.validateName();
        this.validateEmail();
        this.validatePassword();
  
        if (!this.nameError && !this.emailError && !this.passwordError && !this.confirmPasswordError) {
          try {
            const response = await window.axios.post('add-user', {
              name      : this.name,
              email     : this.email,
              password  : this.password,
              password_confirmation : this.confirmPassword,
            });
  
            this.successMessage = response.data.message ? response.data.message : 'User registered successfully!';
            this.errorMessage = '';
            
            // Reset form fields
            this.name = '';
            this.email = '';
            this.password = '';
            this.confirmPassword = '';

             // Redirect to user list page after displaying the success message
            setTimeout(() => {
                this.$router.push({ name: 'listuser' });
            }, 2000);
            
          } catch (error) {
              if (error.response) {
                  if (error.response.status === 422) {
                      // Handle validation errors
                      this.errorMessage = error.response ? error.response.data.message : 'Registration failed. Please try again.';
                  } else {
                          
                          this.errorMessage= 'Some unauthorized user';
                      }
                  } else {
                      this.errorMessage = 'An error occurred. Please try again later.';
                  }
            
              this.successMessage = '';
          }
        } else {
          this.errorMessage = 'Please fix the errors above.';
          this.successMessage = '';
        }
      },
    },
  };
  </script>
  

  