import axios from 'axios'

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
            console.log(err);
        });
    }

    async REGISTER(username, email, password) {
        return await axios.post(API_URL + 'register', {
            username: username,
            email: email,
            password: password
        })
        .catch(err => {
            console.log(err);
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