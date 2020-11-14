import axios from 'axios';

const user= {
    namespaced: true,
    state: {
        users: []
    },
    getters: {
        users: (state) => {
            return state.users;
        }
    }, 
    mutations: {

    },
    actions: {
        /*INDEX({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get('/admin/job-applications?page_size=10&' + payload)
                     .then(response => {
                    resolve(response.data);
                });
            });
        },*/
        
        SHOW({ comit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get('/admin/users/' + payload)
                     .then(response => {
                    resolve(response.data);
                });
            });
        }
    }
};

export default user;