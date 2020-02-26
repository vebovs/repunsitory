import axios from 'axios';

const API_URL = 'http://localhost:8000/api/';

class AuthService {
  login(user) {
    return axios
      .post(API_URL + 'login', {
        email: user.username,
        password: user.password
      })
      .then(response => {
        if (response.data.accessToken) {
          localStorage.setItem('user-token', JSON.stringify(response.data.accessToken));
          
        }
        return response.data;
      });
  }

  logout() {
    localStorage.removeItem('user-token');
  }

  register(user) {
    return axios.post(API_URL + 'register', {
      username: user.username,
      email: user.email,
      password: user.password
    });
  }
}

export default new AuthService();