import axios from 'axios'
import store from '../store';

const API_URL = process.env.MIX_API_URL;

class Admin {
    //Gets all the users
    async USERS() {
        return await axios.get(API_URL + 'admin/users', {
            withCredentials: true
        })  
        .catch(err => console.log(err));
    }

    //Allows the admin to delete any user
    async DELETE_USER(id) {
        return await axios.delete(API_URL + 'admin/user/' + `${id}`, {
            withCredentials: true
        })
        .catch(err => {
            store.commit('error', err.response.data.message);
        });
    }

    //Allows the admin to delete any pun
    async DELETE_PUN(id) {
        return await axios.delete(API_URL + 'admin/pun/' + `${id}`, {
            withCredentials: true
        })
        .catch(err => {
            store.commit('error', err.response.data.message);
        });
    }

    //Allows the admin to ban any user
    async BAN_USER(id) {
        return await axios.delete(API_URL + 'admin/ban/' + `${id}`, {
            withCredentials: true
        })
        .catch(err => {
            store.commit('error', err.response.data.message);
        });
    }
}

export default new Admin();