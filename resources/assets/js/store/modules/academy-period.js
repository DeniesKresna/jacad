import axios from 'axios';
import qs from 'qs';

const academy_period= {
    namespaced: true,
    state: {
        academy_periods: []
    },
    getters:{
        academy_periods: (state) => {
            return state.academy_periods;
        }
    },
    mutations: {
        
    },
    actions: {
        INDEX({ commit }, payload){
            return new Promise((resolve, reject) => {
                axios.get(`/admin/academy-periods?page_size=10&${payload}`).then(response => {
                    resolve(response.data);
                });
            });
        },
        
        SHOW({ commit }, payload){
            return new Promise((resolve, reject) => {
                axios.get(`/admin/academy-periods/${payload}`).then(response => {
                    resolve(response.data);
                });
            });
        },

        STORE({ commit }, payload) {
            return new Promise((resolve, reject) => {
                let formData = new FormData();  
                
                formData.append('period', payload.period);
                formData.append('price', payload.price);
                formData.append('description', payload.description);
                formData.append('academy_id', payload.academy_id);
                formData.append('mentors', JSON.stringify(payload.mentors));

                axios.post('/admin/academy-periods', formData).then(response => {
                    resolve(response.data);
                });
            });
        },
        
        UPDATE({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.put(`/admin/academy-periods/${payload.id}`, qs.stringify(payload)).then(response => {
                    resolve(response.data);
                });
            });
        },
        
        DESTROY({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.delete(`/admin/academy-periods/${payload}`).then(response => {
                    resolve(response.data)
                });
            })
        },

        ACTIVATE({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.put(`/admin/academy-periods/activate/${payload}`).then(response => {
                    resolve(response.data);
                });
            });
        },
        
        PERIOD_CUSTOMERS({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get(`/admin/academy-periods/customers?page_size=10&${payload}`).then(response => {
                    resolve(response.data);
                });
            });
        },

        DESTROY_PERIOD_CUSTOMER({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.delete(`/admin/academy-periods/customers/${payload}`).then(response => {
                    resolve(response.data);
                });
            });
        }
    }
};

export default academy_period;