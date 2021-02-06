import Api from './Api';
import getCookie from './Csrf';

export default {
    async register(form) {
        await getCookie();
        return Api.post('/register' , form);
    } ,
    async login(form) {
        await getCookie();
        return Api.post('/login' , form);
    },
    async logout() {
        await getCookie();
        return Api.post('/logout');
    },
    user() {
        return Api.get('/user');
    }
}
