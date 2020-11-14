import axios from 'axios';

const job_application= {
    namespaced: true,
    state: {
        job_applications: []
    },
    getters: {
        job_applications: (state) => {
            return state.job_applications;
        }
    }, 
    mutations: {

    },
    actions: {
        INDEX({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get('/admin/job-applications?page_size=10&' + payload)
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

export default job_application;