import axios from 'axios';
import qs from 'qs';

const ask_career= {
    namespaced: true,
    state: {
        ask_careers: []
    },
    getters:{
        ask_careers: (state) => {
            return state.ask_careers;
        }
    },
    mutations: {
        
    },
    actions: {
        INDEX({ commit }, payload){
            return new Promise((resolve, reject) => {
                axios.get(`/admin/ask-careers?page_size=10&${payload}`).then(response => {
                    resolve(response.data);
                });
            });
        },

        SHOW({ commit }, payload){
            return new Promise((resolve, reject) => {
                axios.get(`/admin/ask-careers/${payload}`).then(response => {
                    resolve(response.data);
                });
            });
        },

        STORE({ commit }, payload) {
            return new Promise((resolve, reject) => {
                let formData = new FormData();  
                
                formData.append('name', payload.name);
                formData.append('schedule', payload.schedule);
                formData.append('price', payload.price);
                formData.append('mentor', payload.mentor);
                
                axios.post('/admin/ask-careers', formData, {
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
                formData.append('schedule', payload.schedule);
                formData.append('price', payload.price);
                formData.append('mentor', payload.mentor);
                
                axios.post('/admin/ask-careers/update/' + payload.id, formData, {
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
                axios.delete(`/admin/ask-careers/${payload}`).then(response => {
                    resolve(response.data)
                });
            })
        }
    }
};

export default ask_career;