<!-- Dashboard Template -->
<template>
    <div class="container">
      <h2>Welcome, {{ user.name }} - Transaction List</h2>
    
    <table  class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Location</th>
          <th>Amount</th>
          <th>Transaction type</th>
          <th>Status</th>
          <th>Date</th>
         
        </tr>
      </thead>
      <tbody>
        <tr v-for="transaction in transactions.data" :key="transaction.id">
          <td>{{ transaction.id }}</td>
          <td>{{ transaction.location.name }}</td>
          <td>{{ transaction.amount }}</td>
          <td>{{ transaction.transaction_type }}</td>
          <td>{{ transaction.status }}</td>
          <td>{{ transaction.created_at }}</td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination Controls -->
    <div class="pagination">
      <button @click="prevPage" :disabled="!transactions.prev_page_url">Previous</button>
      <span>Page {{ transactions.current_page }} of {{ transactions.last_page }}</span>
      <button @click="nextPage" :disabled="!transactions.next_page_url">Next</button>
    </div>

    </div>
</template>
  
  <script>
  import { mapState, mapActions } from 'vuex';
  
  export default {
    data() {
        return {
        transactions: {
            data: [],
            current_page: 1,
            last_page: 1,
            next_page_url: null,
            prev_page_url: null,
        },
        perPage: 100, // Number of items per page
        };
    },
    computed: {
      ...mapState('auth', ['user']),
    },
    methods : {

        async fetchTransactions(page = 1) {
        try {
            const token = localStorage.getItem('token');
            const response = await window.axios.get('transaction/list', {
                params: {
                    page,
                    per_page: this.perPage,
                },
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            });
            this.transactions = response.data;
            } catch (error) {
                console.error('Error fetching transactions:', error);
            }
        },
    nextPage() {
      if (this.transactions.next_page_url) {
        this.fetchTransactions(this.transactions.current_page + 1);
      }
    },
    prevPage() {
      if (this.transactions.prev_page_url) {
        this.fetchTransactions(this.transactions.current_page - 1);
      }
    },
    },
    mounted() {
        this.fetchTransactions(); // Fetch transactions on component mount
    },
  };
  </script>