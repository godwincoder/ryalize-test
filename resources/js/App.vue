<template>
    <div id="app">
      <header>
        <h1>Test Application</h1>
        <Menu />
      </header>
      <main>
        <router-view></router-view> <!-- This is where the routed components will render -->
      </main>
      <footer>
        <p>© 2024 Test Application</p>
      </footer>
    </div>
  </template>
  
  <script>
  import Menu from './components/Menu.vue';
  export default {
    name: 'App',
    components: {
        Menu,
    },
  };
  </script>
  
  <style scoped>
  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    text-align: center;
    color: #2c3e50;
    margin-top: 30px;
  }
  
  nav {
    margin-bottom: 20px;
  }
  
  nav a {
    margin: 0 15px;
    text-decoration: none;
    color: #42b983;
  }
  
  footer {
    margin-top: 20px;
  }
  </style>
  