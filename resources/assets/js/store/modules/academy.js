import axios from 'axios';
import qs from 'qs';

const academy= {
    namespaced: true,
    state: {
        academies: []
    },
    getters:{
        academies: (state) => {
            return state.academies;
        }
    },
    mutations: {
        
    },
    actions: {
        INDEX({ commit }, payload){
            return new Promise((resolve, reject) => {
                axios.get('/admin/academies?page_size=10&' + payload).then(response => {
                    resolve(response.data);
                });
            });
        },

        SHOW({ commit }, payload){
            return new Promise((resolve, reject) => {
                axios.get('/admin/academies/' + payload).then(response => {
                    resolve(response.data);
                });
            });
        },

        STORE({ commit }, payload) {
            return new Promise((resolve, reject) => {
                let formData = new FormData();  
                
                formData.append('name', payload.name);
                formData.append('desc', payload.desc);
                formData.append('price', payload.price);
                formData.append('category', payload.category);
                formData.append('tags', payload.tags);
                formData.append('file', payload.file);
                
                axios.post('/admin/academies', formData, {
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
                formData.append('desc', payload.desc);
                formData.append('price', payload.price);
                formData.append('category', payload.category);
                formData.append('tags', payload.tags);
                formData.append('file', payload.file);
                
                axios.post('/admin/academies/update/' + payload.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    resolve(response.data);
                });
            });
        },
        
        DESTROY({ commit }, payload){
            return new Promise((resolve, reject) => {
                axios.delete('/admin/academies/' + payload).then(response => {
                    resolve(response.data)
                });
            })
        }
    }
};

export default academy;