import Vuex from 'vuex';
import Vue from 'vue';
import AuthService from '../services/auth.service.js';
import UserService from '../services/user.service.js';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    status: false,
    username: '',
    token: '',
    role: '',
    puns: []
  },

  actions: {
    async login({ commit }, data) {
        return await AuthService.LOGIN(data.email, data.password)
        .then(response => {
          commit('set', response.data)
          return Promise.resolve();
        })
        .catch(err => {
          commit('reset');
          return Promise.reject(err);
        });
    },

    async register({ commit }, data) {
      return await AuthService.REGISTER(data.username, data.email, data.password)
      .then(() => {
        commit('reset');
        return Promise.resolve();
      })
      .catch(err => {
        commit('reset');
        return Promise.reject(err);
      });
    },

    async logout({ commit }) {
      return await AuthService.LOGOUT()
      .then(() => {
        commit('reset')
        return Promise.resolve();
      })
      .catch(err => {
        commit('reset')
        return Promise.reject(err);
      });
    },

    async create({ commit }, data) {
      return await UserService.CREATE(data.title, data.body)
      .then(response => {
        commit('update', response.data);
        return Promise.resolve();
      })
      .catch(err => {
        return Promise.reject(err);
      });
    },

    async show({ commit }) {
      return await UserService.SHOW()
      .then(response => {
        commit('puns', response.data);
        return Promise.resolve();
      })
      .catch(err => {
        return Promise.reject(err);
      });
    }
  },

  mutations: {
    set: (state, data) => {
        state.status = data.success;
        state.username = data.username;
        state.token = data.token;
        state.role = data.role;
    },

    reset: (state) => {
        state.status = false;
        state.username = '';
        state.token = '';
        state.role = '';
    },

    puns: (state, data) => {
      state.puns = data;
    },

    update: (state, data) => {
      state.puns.push({
        id: data.pun.id,
        title: data.pun.title,
        body: data.pun.body
      })
    }
  }
});