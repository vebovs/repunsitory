import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VeeValidate from 'vee-validate';
import router from './router.js';
import store from './store';
import App from './components/App.vue';

window.vue = require('vue')

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.prototype.$axios = axios;

Vue.use(VeeValidate);

Vue.router = router
App.router = Vue.router;

Vue.use(Vuex);

const app = new Vue({
    el: '#app',
    router,
    store,
    render: app => app(App)
  });