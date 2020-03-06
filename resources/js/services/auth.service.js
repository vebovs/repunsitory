import axios from 'axios'
import store from '../store';

//const API_URL = 'http://192.168.1.5:8000/api/';
const API_URL = 'http://localhost:8000/api/';

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
            store.commit('error', err.response.data.message);
        });
    }

    async LOGOUT() {
        return await axios.get(API_URL + 'logout', {
            withCredentials: true
        })
        .catch(err => console.log(err));
    }
}

export default new Auth();