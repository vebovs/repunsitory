import axios from 'axios'
import store from '../store';

const API_URL = process.env.MIX_API_URL;

class User {
    async CREATE(title, body) {
        return await axios.post(API_URL + 'pun', {
            title: title,
            body: body
          },
          {
            withCredentials: true
          })
          .catch(err => {
            store.commit('error', err.response.data.message);
          });
    }

    async SHOW() {
        return await axios.get(API_URL + 'puns', {
            withCredentials: true
          })
          .catch(err => console.log(err));
    }

    async REMOVE(id) {
      return await axios.delete(API_URL + 'pun/' + `${id}`, {
        withCredentials: true
      })
      .catch(err => {
        store.commit('error', err.response.data.message);
      });
    }

    async UPDATE(id, title, body) {
      return await axios.put(API_URL + 'pun/' + `${id}`, {
        title: title,
        body: body
      },
      {
        withCredentials: true
      })
      .catch(err => {
        store.commit('error', err.response.data.message);
      });
    }

    async DELETE() {
      return await axios.delete(API_URL + 'user', {
        withCredentials: true
      })
      .catch(err => {
        store.commit('error', err.response.data.message);
      });
    }

    async LIKE(id) {
      return await axios.get(API_URL + 'pun/like/' + `${id}`, {
        withCredentials: true
      })
      .catch(err => {
        store.commit('error', err.response.data.message);
      });
    }

    async LIKED() {
      return await axios.get(API_URL + 'user/liked', {
        withCredentials: true
      })
      .catch(err => console.log(err));
    }
}

export default new User();