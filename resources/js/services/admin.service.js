import axios from 'axios'

//const API_URL = 'http://192.168.1.5:8000/api/';
const API_URL = 'http://localhost:8000/api/';

class Admin {
    async USERS() {
        return await axios.get(API_URL + 'admin/users', {
            withCredentials: true
        })  
        .catch(err => console.log(err));
    }

    async DELETE_USER(id) {
        return await axios.delete(API_URL + 'admin/user/' + `${id}`, {
            withCredentials: true
        })
        .catch(err => console.log(err));
    }

    async DELETE_PUN(id) {
        return await axios.delete(API_URL + 'admin/pun/' + `${id}`, {
            withCredentials: true
        })
        .catch(err => console.log(err));
    }
}

export default new Admin();