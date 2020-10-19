import axios from 'axios';

const category= {
    namespaced: true,
    state: {
        categories: []
    },
    getters: {
        categories: (state) => {
            return state.categories;
        }
    }, 
    mutations: {
        
    },
    actions: {
        LIST({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get('/admin/categories/list').then(response => {
                    resolve(response.data);
                });
            });
        },
    }
};

export default category;