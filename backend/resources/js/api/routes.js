import axios from 'axios';

export default {
    all(path) {
        return axios.get(`/api/admin/${path}`);
    },
    find(path, id) {
        return axios.get(`/api/admin/${path}/${id}`);
    },
    update(path, id, data) {
        return axios.put(`/api/admin/${path}/${id}`, data);
    },
    delete(path, id) {
        return axios.delete(`/api/admin/${path}/${id}`);
    },
    create(path ,data) {
        return axios.post(`/api/admin/${path}`, data);
    }
};
