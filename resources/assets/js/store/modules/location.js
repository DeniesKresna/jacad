import axios from 'axios';

const location= {
    namespaced: true,
    state: {
        locations: []
    },
    getters: {
        locations: (state) => {
            return state.locations;
        }
    }, 
    mutations: {
        
    },
    actions: {
        LIST({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get('/admin/locations/list')
                     .then(response => {
                    resolve(response.data);
                });
            });
        }
    }
};

export default location;