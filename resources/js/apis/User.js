import Api from './Api';

export default {
     register(form) {
        return Api().post('/register' , form);
    } ,
     login(form) {
        return Api().post('/login' , form);
    },
   logout() {
        return Api().post('/logout');
    },
    user() {
        return Api().get('/user');
    }
}
