import axios from 'axios'

const API_URL = process.env.MIX_API_URL;

class Public {
    async HOME(page_url) {
        return await axios.get(page_url, {
            withCredentials: true
        })  
        .catch(err => console.log(err));
    }

    async VERIFICATION(url) {
        return await axios.get(url, {
            withCredentials: true
        })
        .catch(err => console.log(err));
    }
}

export default new Public();