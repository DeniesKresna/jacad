import axios from 'axios';
import qs from "qs";

const job= {
    namespaced: true,
    state: {
        jobs: []
    },
    getters: {
        jobs: (state) => {
            return state.jobs;
        }
    }, 
    mutations: {

    },
    actions: {
        INDEX({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get('/admin/jobs?page_size=10&' + payload)
                     .then(response => {
                    resolve(response.data);
                });
            });
        },
        
        SHOW({ comit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get('/admin/jobs/' + payload)
                     .then(response => {
                    resolve(response.data);
                });
            });
        }
    }
};

export default job;