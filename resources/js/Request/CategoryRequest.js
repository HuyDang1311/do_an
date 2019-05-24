import Request from './Request';
const API_URL = '/api/categories';

export default class CategoryRequest {
    static getAll (params) {
        return Request.get(API_URL, params);
    }

    static showById (id) {
        return Request.get(`${API_URL}/${id}`);
    }
}