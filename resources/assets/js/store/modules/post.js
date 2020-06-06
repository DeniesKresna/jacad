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
                axios.get('/admin/posts?' + payload).then(response=>{
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

        PUT({commit},payload){
            return new Promis((resolve, reject)=>{
                let data = payload.item;
                axios.put('admin/layouts/' + payload.item.id, qs.stringify(payload.item)).then(response=>{
                    resolve(response.data)
                });
            })
        }
    }
}

export default post