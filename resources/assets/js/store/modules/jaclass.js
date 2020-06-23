import axios from 'axios';
import qs from "qs";
const layout = {
    namespaced: true,
    state: {
        jaclasses: []
        
    },
    getters:{
        jaclasses: (state)=>{
            return state.jaclasses;
        }
    },
    mutations: {
        
    },
    actions: {
        GET({commit},payload){
            return new Promise((resolve,reject)=>{
                let page = (payload.page)? payload.page : 1;
                let page_size = (payload.page_size)? payload.page_size : 10;
                axios.get('admin/layouts?page=' + page + '&page_size' + page_size).then(response=>{
                    resolve(response.data);
                });
            });
        },

        STORE({commit},payload){
            return new Promise((resolve, reject)=>{
                let data = payload.item;
                axios.post('admin/layouts', qs.stringify(payload.item)).then(response=>{
                    resolve(response.data);
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

export default layout