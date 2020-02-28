import Vuex from 'vuex';
import Vue from 'vue';
import AuthService from '../services/auth.service.js';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    status: false,
    username: '',
    token: '',
    role: ''
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
        return Promise.reject();
      });
    }
  },

  mutations: {
    set: (state, data) => {
        state.status = data.success;
        state.username = data.username;
        state.token = data.token;
        state.role = data.role;
        console.log(state);
    },

    reset: (state) => {
        state.status = false;
        state.username = '';
        state.token = '';
        state.role = '';
        console.log(state);
    }
  }
});