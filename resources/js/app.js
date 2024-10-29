/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css'
import { createApp } from 'vue';
import router from './router';
import App from './App.vue';
import store from './store';
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp(App);

//Use states of the app

app.use(store);

//Use the route before mounting the app
app.use(router);

// Mount the app
app.mount('#app');
