import axios from 'axios';
import qs from "qs";

const category = {
    namespaced: true,
    state: {
        posts: []
        
    },
    getters:{
        categories: (state)=>{
            return state.categories;
        }
    },
    mutations: {
        
    },
    actions: {
        INDEX({commit},payload){
            return new Promise((resolve,reject)=>{
                axios.get('/admin/jobs?page_size=10&' + payload).then(response=>{
                    resolve(response.data);
                });
            });
        },

        LIST({commit},payload){
            return new Promise((resolve,reject)=>{
                axios.get('/admin/categories/list').then(response=>{
                    resolve(response.data);
                });
            });
        },

        STORE({commit},payload){
            return new Promise((resolve, reject)=>{
                axios.post('admin/jobs', qs.stringify(payload)).then(response=>{
                    resolve(response.data.data);
                });
            });
        },

        UPDATE({commit},payload){
            return new Promise((resolve, reject)=>{
                axios.put('admin/categories/' + payload.id, qs.stringify(payload)).then(response=>{
                    resolve(response.data)
                });
            })
        },

        DESTROY({commit}, payload){
            return new Promise((resolve, reject)=>{
                axios.delete('admin/categories/' + payload).then(response=>{
                    resolve(response.data)
                });
            })
        }
    }
}

export default category