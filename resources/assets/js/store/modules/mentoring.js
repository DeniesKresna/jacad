import axios from 'axios';

const mentoring= {
    namespaced: true,
    state: {
        mentoring: []
    },
    getters: {
        mentoring: (state) => {
            return state.mentoring;
        }
    }, 
    mutations: {
        
    },
    actions: {
        INDEX({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get(`/admin/mentoring?page_size=10&${payload}`).then(response => {
                    resolve(response.data);
                });
            });
        },
        
        SHOW({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get(`/admin/mentoring/${payload}`).then(response => {
                    resolve(response.data);
                });
            });
        },

        UPDATE({ commit }, payload) {
            return new Promise((resolve, reject) => {
                let formData = new FormData();
                
                /*formData.append('name', payload.name);
                formData.append('description', payload.description);
                formData.append('file', payload.file);*/
                
                axios.post(`/admin/mentoring/update/${payload.id}`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    resolve(response.data);
                });
            });
        }
    }
};

export default mentoring;