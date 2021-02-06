import Api from './Api';

export default function getCookei() {
    return Api.get('/csrf-cookie');
}
