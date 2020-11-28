import axios from 'axios';

const mentor= {
    namespaced: true,
    state: {
        mentors: []
    },
    getters: {
        mentors: (state) => {
            return state.mentors;
        }
    }, 
    mutations: {
        
    },
    actions: {
        INDEX({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get(`/admin/mentors?page_size=10&${payload}`).then(response => {
                    resolve(response.data);
                });
            });
        },

        LIST({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get('/admin/mentors/list').then(response => {
                    resolve(response.data);
                });
            });
        },
        
        SHOW({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get(`/admin/mentors/${payload}`).then(response => {
                    resolve(response.data);
                });
            });
        },

        STORE({ commit }, payload) {
            return new Promise((resolve, reject) => {
                let formData = new FormData();
                
                formData.append('name', payload.name);
                formData.append('description', payload.description);
                formData.append('file', payload.file);
                
                axios.post('/admin/mentors', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    resolve(response.data);
                });
            });
        },

        UPDATE({ commit }, payload) {
            return new Promise((resolve, reject) => {
                let formData = new FormData();
                
                formData.append('name', payload.name);
                formData.append('description', payload.description);
                formData.append('file', payload.file);
                
                axios.post(`/admin/mentors/update/${payload.id}`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    resolve(response.data);
                });
            });
        },
        
        DESTROY({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.delete(`/admin/mentors/${payload}`).then(response => {
                    resolve(response.data);
                });
            });
        },
    }
};

export default mentor;