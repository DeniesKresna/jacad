import axios from 'axios';
import qs from 'qs';

const payment= {
    namespaced: true,
    state: {
        payments: []
    },
    getters:{
        payments: (state) => {
            return state.payments;
        }
    },
    mutations: {
        
    },
    actions: {
        INDEX({ commit }, payload){
            return new Promise((resolve, reject) => {
                
            });
        },
        
        SHOW({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get(`/admin/payments/${payload.id}?data_payment=${payload.data_payment}`).then(response => {
                    resolve(response.data);
                });
            });
        },

        STORE({ commit }, payload) {
            return new Promise((resolve, reject) => {
                
            });
        },
        
        UPDATE({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.put(`/admin/payments/${payload.id}`, qs.stringify(payload)).then(response => {
                    resolve(response.data);
                });
            });
        },
        
        DESTROY({ commit }, payload) {
            return new Promise((resolve, reject) => {
                
            });
        }
    }
};

export default payment;