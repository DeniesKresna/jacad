import axios from 'axios';

const sector= {
    namespaced: true,
    state: {
        sectors: []
    },
    getters: {
        sectors: (state) => {
            return state.sectors;
        }
    }, 
    mutations: {
        
    },
    actions: {
        LIST({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get('/admin/sectors/list')
                     .then(response => {
                    resolve(response.data);
                });
            });
        }
    }
};

export default sector;