import axios from 'axios'
import store from '../store';

const API_URL = process.env.MIX_API_URL;

class User {
    //Pun creation
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

    //Gets a specific users created puns
    async SHOW() {
        return await axios.get(API_URL + 'puns', {
            withCredentials: true
          })
          .catch(err => console.log(err));
    }

    //Allows user to delete one of their puns
    async REMOVE(id) {
      return await axios.delete(API_URL + 'pun/' + `${id}`, {
        withCredentials: true
      })
      .catch(err => {
        store.commit('error', err.response.data.message);
      });
    }

    //Allows user to update one of their puns
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

    //Deletes a user's account
    async DELETE() {
      return await axios.delete(API_URL + 'user', {
        withCredentials: true
      })
      .catch(err => {
        store.commit('error', err.response.data.message);
      });
    }

    //Allows the user to like a pun
    async LIKE(id) {
      return await axios.get(API_URL + 'pun/like/' + `${id}`, {
        withCredentials: true
      })
      .catch(err => {
        store.commit('error', err.response.data.message);
      });
    }

    //Fecthes a user's previously liked puns
    async LIKED() {
      return await axios.get(API_URL + 'user/liked', {
        withCredentials: true
      })
      .catch(err => console.log(err.response.data.message));
    }
}

export default new User();