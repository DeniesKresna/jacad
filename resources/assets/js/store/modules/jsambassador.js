import axios from 'axios';
import qs from "qs";

const jsambassador= {
    namespaced: true,
    state: {
        jsambassadors: []
    },
    getters: {
        jsambassadors: (state) => {
            return state.jsambassadors;
        }
    }, 
    mutations: {
        
    },
    actions: {
        INDEX({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get(`/admin/studentAmbassadors?page_size=10&${payload}`)
                     .then(response => {
                    resolve(response.data);
                });
            });
        },
        
        UPDATE({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.put(`/admin/studentAmbassadors/${payload}`)
                     .then(response => {
                    resolve(response.data)         
                })
            })
        },

        DESTROY({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.delete(`/admin/studentAmbassadors/${payload}`)
                     .then(response => {
                    resolve(response.data)
                });
            });
        }
    }
};

export default jsambassador;