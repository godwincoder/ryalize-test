<!-- Transaction template -->
<template>
    <h1 class="mb-4">Transactions</h1>
    <div class="container align-items-center justify-content-center">
      <div class="mb-3">
        <label for="date" class="form-label">Select Date:</label>
        <input v-model="date" type="date" class="form-control" id="date" />
        <div v-if="dateError" class="text-danger">{{ dateError }}</div>
      </div>
      <div class="mb-3">
        <label for="location" class="form-label">Select Location:</label>
        <select v-model="locationId" class="form-select" id="location">
          <option value="" disabled>Select a location</option>
          <option v-for="location in locations" :key="location.id" :value="location.id">
            {{ location.name }}
          </option>
        </select>
        <div v-if="locationError" class="text-danger">{{ locationError }}</div>
      </div>
      <button class="btn btn-primary" @click="fetchTransactions">Fetch Transactions</button>
      <br/>
      <div class="container d-flex align-items-center justify-content-center">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>User</th>
            <th>Total transaction</th>
            <th>Location</th>
            
          </tr>
        </thead>
        <tbody>
          <tr v-for="trans in transactions" :key="trans.user_id">
            <td>{{ trans.user.name }}</td>
            <td>{{ trans.total_count }}</td>
            <td>{{ trans.location.name }}</td>
            
          </tr>
        </tbody>
      </table>
      </div>
    </div>
  </template>

<script>

export default {
  name: 'Transactions',
  data() {
    return {
      date: '',
      locationId: null,
      transactions: [],
      locations: [],
      dateError: '',
      locationError: '',
    };
  },
  methods: {
    async fetchLocations() {
      try {
        const response = await window.axios.get('get-location');
        this.locations = response.data;
      } catch (error) {
        console.error('Error fetching locations:', error);
      }
    },
    validateInputs() {
      this.dateError = '';
      this.locationError = '';

      if (!this.date) {
        this.dateError = 'Date is required.';
      }
      
      if (!this.locationId) {
        this.locationError = 'Location is required.';
      }
      
      return !this.dateError && !this.locationError;
    },
    async fetchTransactions() {
      const requestData = {};
      if (this.date) {
        requestData.date = this.date;
      }
      if (this.locationId) {
        requestData.location_id = this.locationId;
      }
      if (this.validateInputs()){
        try {
            const response = await window.axios.post('/transaction/filter', requestData);
            this.transactions       = response.data;
          } catch (error) {
            console.error('Error fetching transactions:', error);
          }
        }
      },
  },
  mounted() {
    this.fetchLocations();
  },
};
</script>