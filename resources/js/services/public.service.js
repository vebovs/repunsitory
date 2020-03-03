import axios from 'axios'

//const API_URL = 'http://192.168.1.5:8000/api/';
const API_URL = 'http://localhost:8000/api/';

class Public {
    async HOME(page_url) {
        return await axios.get(page_url)  
        .catch(err => console.log(err));
    }
}

export default new Public();