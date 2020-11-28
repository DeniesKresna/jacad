import axios from 'axios';
import qs from 'qs';

const blog = {
    namespaced: true,
    state: {
        blogs: []
    },
    getters:{
        blogs: (state) => {
            return state.blogs;
        }
    },
    mutations: {
        
    },
    actions: {
        INDEX({ commit }, payload){
            return new Promise((resolve, reject) => {
                axios.get('/admin/blogs?page_size=10&' + payload).then(response => {
                    resolve(response.data);
                });
            });
        },

        SHOW({ commit },payload){
            return new Promise((resolve, reject) => {
                axios.get('/admin/blogs/' + payload).then(response => {
                    resolve(response.data);
                });
            });
        },
        
        STORE({ commit }, payload) {
            return new Promise((resolve, reject) => {
                let formData = new FormData();
                
                formData.append('title', payload.title);
                formData.append('content', payload.content);
                formData.append('category', payload.category);
                formData.append('tags', payload.tags);
                formData.append('file', payload.file);
                
                axios.post('/admin/blogs', formData, {
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
                
                formData.append('title', payload.title);
                formData.append('content', payload.content);
                formData.append('category', payload.category);
                formData.append('tags', payload.tags);
                formData.append('file', payload.file);
                
                axios.post('/admin/blogs/update/' + payload.id, formData, {
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
                axios.delete('/admin/blogs/' + payload).then(response => {
                    resolve(response.data)
                });
            })
        }
    }
}

export default blog;