import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import router from './router.js';
import store from './store'
import App from './components/App.vue';

window.vue = require('vue')

Vue.use(VueRouter);
Vue.use(Vuex);

Vue.router = router
App.router = Vue.router;

const app = new Vue({
    el: '#app',
    router,
    store,
    render: app => app(App)
  });