import axios from 'axios';

const opening= {
    namespaced: true,
    state: {
        openings: []
    },
    getters: {
        openings: (state) => {
            return state.openings;
        }
    }, 
    mutations: {

    },
    actions: {
        /*INDEX({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get('/admin/jobs?page_size=10&' + payload)
                     .then(response => {
                    resolve(response.data);
                });
            });
        },*/
        
        SHOW({ comit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get('/admin/openings/' + payload).then(response => {
                    resolve(response.data);
                });
            });
        },

        STORE({ commit }, payload) {
            return new Promise((resolve, reject) => {
                let formData = new FormData();
                
                formData.append('service', payload.service);
                formData.append('content', payload.content);

                axios.post('/admin/openings', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    resolve(response.data);
                });
            });
        },
        
        /*DESTROY({ commit }, payload){
            return new Promise((resolve, reject) => {
                axios.delete('/admin/jobs/' + payload).then(response => {
                    resolve(response.data)
                });
            })
        }*/
    }
}

export default opening;