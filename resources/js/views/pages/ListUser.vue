<!-- List template -->
<template>
    <div class="container mt-5">
      <h2>User List</h2>
      <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td><button @click="confirmDelete(user.id)">Delete</button></td>
          </tr>
        </tbody>
      </table>
      <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
    </div>
  </template>
  
  <script>
  
  export default {
    name: 'UserList',
    data() {
      return {
        users: [],
        errorMessage: '',
        successMessage: '',
      };
    },
    mounted() {
      this.fetchUsers();
    },
    methods: {
    async fetchUsers() {
        try {
            const response = await window.axios.get('/list-user'); 
            this.users = response.data; // Assuming the response contains the user data
        } catch (error) {
            this.errorMessage = error.response?.data?.message || 'Failed to fetch users';
        }
    },
    async confirmDelete(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            await this.deleteUser(userId);
        }
    },
    async deleteUser(userId) {
        try {
            //Api call to delete user
            const response = await  window.axios.delete(`/delete-user/${userId}`);
            // Handle success
            this.users = this.users.filter(user => user.id !== userId);
            this.successMessage = response.data.message ? response.data.message : 'Deletion success';
          //  alert(response.data.message);
        } catch (error) {
            // Handle error
            this.errorMessage = error.response?.data?.message || 'Error deleting user';
        
        }
    },
      
    },
  };
  </script>
  
 
  