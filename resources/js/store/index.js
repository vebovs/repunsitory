import Vuex from 'vuex';
import Vue from 'vue';
import AuthService from '../services/auth.service.js';
import UserService from '../services/user.service.js';
import PublicService from '../services/public.service.js';
import AdminService from '../services/admin.service.js';
import publicService from '../services/public.service.js';
import userService from '../services/user.service.js';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    status: false, //Checks to see if anyone is logged in
    username: '',
    token: '', //JWT
    role: '', //admin or regular user
    puns: [], //User's previously created puns
    home: [], //All puns to be displayed on the front page
    pagination: {},
    users: [], //All users to only be displayed for the admins
    error: '', //Error message in case anything goes wrong
    liked_puns: '' //User's liked puns
  },

  actions: {
    //User login
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

    //User registration
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

    //User logout
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

    //Fetch credentials upon page refresh
    async refresh({ commit }) {
      return await AuthService.REFRESH()
      .then(response => {
        commit('set', response.data)
        return Promise.resolve();
      })
      .catch(err => {
        return Promise.reject(err);
      })
    },

    //Allows user to create a pun
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

    //Fetches all of the user's previously created puns
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

    //Allows user's to delete one of their puns
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

    //Allows user to update a pun
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

    //Allows a user to delete themselves
    async delete({ commit }) {
      return await UserService.DELETE()
      .then(() => {
        commit('reset');
        return Promise.resolve();
      })
      .catch(err => {
        return Promise.reject(err);
      })
    },

    //Allows a user to like a pun
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

    //Gets a user's previously liked puns
    async liked({ commit }) {
      return await userService.LIKED()
      .then(response => {
        commit('liked', response.data);
        return Promise.resolve();
      })
      .catch(err => {
        return Promise.reject(err);
      })
    },

    //Fetches all the puns to be displayed on the front page
    async home({ commit }, data) {
      return await PublicService.HOME(data.page_url)
      .then(response => {
        commit('public', response.data);
        return Promise.resolve();
      })
      .catch(err => {
        return Promise.reject(err);
      });
    },

    //Gets all the user to be displayed on the admin dashboard
    async users({ commit }) {
      return await AdminService.USERS()
      .then(response => {
        commit('admin', response.data);
        return Promise.resolve();
      })
      .catch(err => {
        return Promise.reject(err);
      });
    },

    //Allows an admin to delete a user
    async delete_user({ commit }, data) {
      return await AdminService.DELETE_USER(data.id)
      .then(response => {
        commit('remove_user', response.data);
        return Promise.resolve();
      })  
      .catch(err => {
        return Promise.reject(err);
      });
    },

    //Allows an admin to ban a user
    async ban_user({ commit }, data) {
      return await AdminService.BAN_USER(data.id)
      .then(response => {
        commit('remove_user', response.data);
        return Promise.resolve();
      })  
      .catch(err => {
        return Promise.reject(err);
      });
    },

    //Allows an admin to delete any pun
    async delete_pun({ commit }, data) {
      return await AdminService.DELETE_PUN(data.id)
      .then(response => {
        commit('remove_pun', response.data);
        return Promise.resolve();
      })
      .catch(err => {
        return Promise.reject(err);
      });
    },

    //Email verification
    async verification({ commit }, data) {
      return await publicService.VERIFICATION(data.url)
      .then(() => {
        return Promise.resolve();
      })
      .catch(err => {
        return Promise.reject(err);
      });
    }
},

  mutations: {
    //Sets the user credentials
    set: (state, data) => {
      state.status = data.success;
      state.username = data.username;
      state.token = data.token;
      state.role = data.role;
    },

    //Removes the user credentials
    reset: (state) => {
      state.status = false;
      state.username = '';
      state.token = '';
      state.role = '';
    },

    //Sets the user's puns
    puns: (state, data) => {
      state.puns = data;
    },

    //Adds the newly created pun to be displayed immediately upon creation
    create: (state, data) => {
      state.puns.unshift({
        id: data.pun.id,
        title: data.pun.title,
        body: data.pun.body
      })
    },

    //Deletes the pun immediately 
    remove: (state, data) => {
      state.puns = state.puns.filter(e => e.id != data.id);
    },

    //Updates the pun
    update: (state, data) => {
      state.puns.find(e => {
        if(e.id === data.pun.id) {
          e.title = data.pun.title;
          e.body = data.pun.body;
        } 
      });
    },

    //Sets all puns to be displayed on the front page
    public: (state, data) => {
      state.home = data.data;
      state.pagination = {
        current_page: data.meta.current_page,
        last_page: data.meta.last_page,
        next_page_url: data.links.next,
        prev_page_url: data.links.prev
      };

      //Checks to see if there are any puns the user has previosly liked an sets them as liked
      //To be used to generate the correct type of like button (depending on if the user already has liked the pun)
      for(let i = 0; i < state.home.length; i++) {
        for(let j = 0; j < state.liked_puns.length; j++) {
          if(state.home[i].id === state.liked_puns[j].id) {
              state.home[i].liked = true;
            }
         }
      }
    },

    //Likes a pun
    likes: (state, data) => {
      state.home.find(e => {
        if(e.id === data.pun.id) {
          e.likes = data.pun.likes;
          e.liked = true;
          state.liked_puns.push(data.pun);
        }
      });
    },

    //Sets all liked puns
    liked: (state, data) => {
      state.liked_puns = data.liked_puns;
    },

    //Sets all the users
    admin: (state, data) => {
      state.users = data.users;
    },

    //An admin deletes a user
    remove_user: (state, data) => {
      state.users = state.users.filter(e => e.id != data.id);
    },

    //An admin deletes a pun
    remove_pun: (state, data) => {
      state.home = state.home.filter(e => e.id != data.id);
    },

    //Error variable to the displayed
    error: (state, data) => {
      state.error = data;
    }
  }
});