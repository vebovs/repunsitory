import bootstrap from 'bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './components/Home.vue';

window.Vue = require('vue');
Vue.use(VueRouter);

const routes = [
    { path: '/', component: Home }
]

const router = new VueRouter({
    routes: routes,
    mode: 'history'
});

const app = new Vue({
    el: '#app',
    router
  });
