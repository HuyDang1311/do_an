import Request from './Request';
const API_URL = '/api/products';

export default class ProductRequest {
    static getAll (params) {
        return Request.get(API_URL, params);
    }

    static showById (id) {
        return Request.get(`${API_URL}/${id}`);
    }

    static create (formData, header) {
        return Request.post(API_URL, formData, header);
    }
}