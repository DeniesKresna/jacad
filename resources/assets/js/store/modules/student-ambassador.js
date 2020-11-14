import axios from 'axios';

const student_ambassador= {
    namespaced: true,
    state: {
        student_ambassadors: []
    },
    getters: {
        student_ambassadors: (state) => {
            return state.student_ambassadors;
        }
    }, 
    mutations: {
        
    },
    actions: {
        INDEX({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get(`/admin/student-ambassadors?page_size=10&${payload}`)
                     .then(response => {
                    resolve(response.data);
                });
            });
        },
        
        UPDATE({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.put(`/admin/student-ambassadors/${payload}`)
                     .then(response => {
                    resolve(response.data)         
                })
            })
        },

        DESTROY({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.delete(`/admin/student-ambassadors/${payload}`)
                     .then(response => {
                    resolve(response.data)
                });
            });
        }
    }
};

export default student_ambassador;