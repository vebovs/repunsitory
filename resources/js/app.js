import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './components/App.vue';
import Dashboard from './components/user/Dashboard.vue';
import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';


window.vue = require('vue')

axios.defaults.baseURL = 'http://localhost:8000/api';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const router = new VueRouter({
    routes: [{
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard
    }],
    mode: 'history'
});

Vue.router = router
App.router = Vue.router;

const app = new Vue({
    el: '#app',
    router,
    render: app => app(App)
  });