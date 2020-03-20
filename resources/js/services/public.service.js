import axios from 'axios'

const API_URL = process.env.MIX_API_URL;

class Public {
    //Gets either most popular puns or most recent puns. Is also used for pagination.
    async HOME(page_url) {
        return await axios.get(page_url, {
            withCredentials: true
        })  
        .catch(err => Promise.reject(err));
    }

    //Sends the email verification url parameters to the backend
    async VERIFICATION(url) {
        return await axios.get(url, {
            withCredentials: true
        })
        .catch(err => Promise.reject(err));
    }
}

export default new Public();