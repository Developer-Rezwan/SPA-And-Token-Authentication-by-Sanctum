import axios from 'axios'
const BaseApi = axios.create({
    baseURL: 'http://127.0.0.1:8000/api',
});

let Api = function() {
    const AUTH_TOKEN = localStorage.getItem('token');
    if (AUTH_TOKEN) {
        BaseApi.defaults.headers.common['Authorization'] = `Bearer ${AUTH_TOKEN}`;
    }
    return BaseApi;
}
export default Api;
