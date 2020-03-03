import Vuex from 'vuex';
import Vue from 'vue';
import AuthService from '../services/auth.service.js';
import UserService from '../services/user.service.js';
import PublicService from '../services/public.service.js';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    status: false,
    username: '',
    token: '',
    role: '',
    puns: [],
    home: [],
    pagination: {}
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
        commit('create', response.data);
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
    },

  async remove({ commit }, data) {
    return await UserService.REMOVE(data.id)
    .then(response => {
      commit('remove', response.data);
      return Promise.resolve();
    })
    .catch(err => {
      return Promise.reject(err);
    });
  },

  async update({ commit }, data) {
    return await UserService.UPDATE(data.id, data.title, data.body)
    .then(response => {
      commit('update', response.data);
      return Promise.resolve();
    })
    .catch(err => {
      return Promise.reject(err);
    });
  },

  async like({ commit }, data) {
    return await UserService.LIKE(data.id)
    .then(response => {
      commit('likes', response.data);
      return Promise.resolve();
    })
    .catch(err => {
      return Promise.reject(err);
    });
  },

  async home({ commit }, data) {
    return await PublicService.HOME(data.page_url)
    .then(response => {
      commit('public', response.data);
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

    create: (state, data) => {
      state.puns.push({
        id: data.pun.id,
        title: data.pun.title,
        body: data.pun.body
      })
    },

    remove: (state, data) => {
      state.puns = state.puns.filter(e => e.id != data.id);
    },

    update: (state, data) => {
      state.puns.find(e => {
        if(e.id === data.pun.id) {
          e.title = data.pun.title;
          e.body = data.pun.body;
        } 
      });
    },

    public: (state, data) => {
      state.home = data.data;
      state.pagination = {
        current_page: data.meta.current_page,
        last_page: data.meta.last_page,
        next_page_url: data.links.next,
        prev_page_url: data.links.prev
      };
    },

    likes: (state, data) => {
      state.home.find(e => {
        if(e.id === data.pun.id) {
          e.likes = data.pun.likes;
        }
      });
    }
  }
});