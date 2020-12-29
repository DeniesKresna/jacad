import axios from 'axios';
import Vue from 'vue';
import VueSwal from 'vue-swal'
import store from './store'
 
Vue.use(VueSwal);
//import store from 'your/store/path/store'

export default function setup() {
    axios.interceptors.request.use(function(config) {
        store.commit('LOADING_START');

        const token = localStorage.token;
        if (token) {
            config.headers.Token = token;
        }

        return config;
    }, function(err) {
        store.commit('LOADING_FINISH');

        return Promise.reject(err);
    });

    axios.interceptors.response.use(function(response) {
        store.commit('LOADING_FINISH');

        if (response.data.message) {
            Vue.$swal('Success', response.data.message, 'success');
        }

        return response;
    }, function(error) {
        store.commit('LOADING_FINISH');
        
        if (error.response.status) {
            switch (error.response.status) {
                case 400:
                    Vue.$swal('Failed', 'Some trouble in your request', 'error');
                    break;
                case 401:
                    Vue.$swal('Session Expired', 'You must relogin', 'error');
                    break;
                case 403:
                    Vue.$swal('No Access', 'You dont have access', 'error');
                    break;
                case 404:
                    Vue.$swal('No Data', 'Use another data', 'error');
                    break;
                case 422:
                    let span= document.createElement('span');
                    let msg= '';
                    let errors= error.response.data.message;

                    for (let err in errors) {
                        msg+= errors[err]+'<br>';
                    }

                    span.innerHTML= msg+"</ul>";
                    
                    Vue.$swal({
                        title: 'Error Validation', 
                        content: span, 
                        icon: 'error'
                    });
                    break;
                case 500:
                    console.log(error.response.data);
                    Vue.$swal('Server Error', 'You can try again later or Call Customer Service', 'error');
                    break;
                default:
                    Vue.$swal('Unknown Error', 'You can try again later or Call Customer Service', 'error');
            }

            return Promise.reject(error.response);
        }
    });
}