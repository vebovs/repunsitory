import axios from 'axios'

//const API_URL = 'http://192.168.1.5:8000/api/';
const API_URL = 'http://localhost:8000/api/';

class User {
    async CREATE(title, body) {
        return await axios.post(API_URL + 'pun', {
            title: title,
            body: body
          },
          {
            withCredentials: true
          })
          .catch(err => console.log(err));
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
      .catch(err => console.log(err));
    }

    async UPDATE(id, title, body) {
      return await axios.put(API_URL + 'pun/' + `${id}`, {
        title: title,
        body: body
      },
      {
        withCredentials: true
      })
      .catch(err => console.log(err));
    }
}

export default new User();