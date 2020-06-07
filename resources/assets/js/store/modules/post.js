import axios from 'axios';
import qs from "qs";

const post = {
    namespaced: true,
    state: {
        posts: []
        
    },
    getters:{
        posts: (state)=>{
            return state.posts;
        }
    },
    mutations: {
        
    },
    actions: {
        INDEX({commit},payload){
            return new Promise((resolve,reject)=>{
                axios.get('/admin/posts?page_size=10&' + payload).then(response=>{
                    resolve(response.data);
                });
            });
        },

        SHOW({commit},payload){
            return new Promise((resolve,reject)=>{
                axios.get('/admin/posts/' + payload).then(response=>{
                    resolve(response.data);
                });
            });
        },

        STORE({commit},payload){
            return new Promise((resolve, reject)=>{
                axios.post('admin/posts', qs.stringify(payload)).then(response=>{
                    resolve(response.data.data);
                });
            });
        },

        UPDATE({commit},payload){
            return new Promise((resolve, reject)=>{
                axios.put('admin/posts/' + payload.id, qs.stringify(payload)).then(response=>{
                    resolve(response.data)
                });
            })
        },

        DESTROY({commit}, payload){
            return new Promise((resolve, reject)=>{
                axios.delete('admin/posts/' + payload).then(response=>{
                    resolve(response.data)
                });
            })
        }
    }
}

export default post