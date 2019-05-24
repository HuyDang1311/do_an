export default class {
    static get (api, params) {
        return axios.get(api, {
            params: params,
        }).then(response => {
            return response.data;
        }).catch(error => {
            return error.response.data;
        });
    }

    static post (api, formData, header) {
        return axios.post(api, formData, header).then(response => {
            return response.data;
        }).catch(error => {
            return error.response.data;
        });
    }
}