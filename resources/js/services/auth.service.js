import axios from 'axios'
import store from '../store';

const API_URL = process.env.MIX_API_URL;

class Auth {
    async LOGIN(email, password) {
        return await axios.post(API_URL + 'login', {
            email: email,
            password: password
        },
        {
            withCredentials: true
        })
        .catch(err => {
            store.commit('error', err.response.data.message);
        });
    }

    async REGISTER(username, email, password) {
        return await axios.post(API_URL + 'register', {
            username: username,
            email: email,
            password: password
        },
        {
            withCredentials: true
        })
        .catch(err => {
            console.log(err.response.data.message);
            store.commit('error', err.response.data.message);
        });
    }

    async LOGOUT() {
        return await axios.get(API_URL + 'logout', {
            withCredentials: true
        })
        .catch(err => console.log(err));
    }

    async REFRESH() {
        return await axios.get(API_URL + 'refresh', {
            withCredentials: true
        })
        .catch(err => {
            Promise.reject(err);
        });
    }
}

export default new Auth();