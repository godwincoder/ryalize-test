import { createRouter, createWebHistory } from 'vue-router';

import Login from '../views/Login.vue';
import Register from '../views/Register.vue';
import ListUser from '../views/pages/ListUser.vue';
import Dashboard from '../views/pages/Dashboard.vue';
import Transaction from '../views/pages/Transaction.vue';


const routes = [
    { name : 'listuser' , path: import.meta.env.BASE_URL+'/list-user', component: ListUser },
    { name : 'login' , path: import.meta.env.BASE_URL+'/login', component: Login },
    { name : 'register' , path: import.meta.env.BASE_URL+'/register-user', component: Register },
    { name : 'dashboard' , path: import.meta.env.BASE_URL+'/dashboard', component: Dashboard },
    { name : 'transaction' , path: import.meta.env.BASE_URL+'/transaction', component: Transaction },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;