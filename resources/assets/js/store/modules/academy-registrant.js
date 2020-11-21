import axios from 'axios';
import qs from 'qs';

const academy_registrant= {
    namespaced: true,
    state: {
        academy_registrants: []
    },
    getters:{
        academy_registrants: (state) => {
            return state.academy_registrants;
        }
    },
    mutations: {
        
    },
    actions: {
        INDEX({ commit }, payload){
            return new Promise((resolve, reject) => {
                axios.get('/admin/academy-registrants?page_size=10&' + payload).then(response => {
                    resolve(response.data);
                });
            });
        }
    }
};

export default academy_registrant;