

const state = {
  user: null,
  token: localStorage.getItem('token') || null,
};

const mutations = {
  setUser(state, user) {
    state.user = user;
  },
  setToken(state, token) {
    state.token = token;
    localStorage.setItem('token', token);
  },
  clearAuth(state) {
    state.user = null;
    state.token = null;
    localStorage.removeItem('token');
  },
};

const actions = {
  
  //Authentication function 
  async login({ commit }, { email, password , device_name}) {
    try {
      const response = await window.axios.post('/create/token', { email, password , device_name});
      commit('setUser', response.data.user);
      commit('setToken', response.data.token);
      
    } catch (error) {
      console.log('Login failed:', error);
      throw error; // Rethrow error for handling in the component
    }
  },
  // Logout
  logout({ commit }) {
    commit('clearAuth');
  },

};

const getters = {
  isAuthenticated(state) {
    return !!state.token;
  },
  user(state) {
    return state.user;
  },
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters,
};
