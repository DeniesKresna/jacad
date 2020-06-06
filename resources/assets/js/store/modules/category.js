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
                axios.get('/admin/categories?' + payload).then(response=>{
                    resolve(response.data);
                });
            });
        },

        STORE({commit},payload){
            return new Promise((resolve, reject)=>{
                axios.post('admin/categories', qs.stringify(payload)).then(response=>{
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

export default category