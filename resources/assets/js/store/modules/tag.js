import axios from 'axios';
import qs from "qs";

const tag = {
    namespaced: true,
    state: {
        tags: []
    },
    getters:{
        tags: (state) => {
            return state.tags;
        }
    },
    mutations: {
        
    },
    actions: {
        INDEX({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get('/admin/tags?page_size=10&' + payload).then(response => {
                    resolve(response.data);
                });
            });
        },

        LIST({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get('/admin/tags/list').then(response => {
                    resolve(response.data);
                });
            });
        },

        STORE({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.post('/admin/tags', qs.stringify(payload)).then(response => {
                    resolve(response.data.data);
                });
            });
        },

        UPDATE({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.put('/admin/tags/' + payload.id, qs.stringify(payload)).then(response => {
                    resolve(response.data)
                });
            })
        },
        
        DESTROY({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.delete('/admin/tags/' + payload).then(response => {
                    resolve(response.data)
                });
            })
        }
    }
}

export default tag;