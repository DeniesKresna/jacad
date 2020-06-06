import axios from 'axios';
import Vue from 'vue';
import VueSwal from 'vue-swal'
 
Vue.use(VueSwal)
//import store from 'your/store/path/store'

export default function setup() {
    axios.interceptors.request.use(function(config) {
        const token = localStorage.token;
        if(token) {
            config.headers.Token = token;
        }
        //config.url = "http://localhost:280/jacad/public/api/v1/";
        return config;
    }, function(err) {
        return Promise.reject(err);
    });

    axios.interceptors.response.use(
          response => {
            if (response.status === 200 || response.status === 201) {
                if(response.data.message){
                    let msg = response.data.message;
                    Vue.$swal("Success", msg, "success");
                }
              return Promise.resolve(response);
            } else {
              return Promise.reject(response);
            }
          },
        error => {
            if (error.response.status) {
              console.log(error.response.data);
              switch (error.response.status) {
                case 400:
                  Vue.$swal("Failed", "Some trouble in your request", "error");
                  break;
                case 401:
                  Vue.$swal("Session Expired", "You must relogin", "error");
                  break;
                case 403:
                  Vue.$swal("No Access", "You dont have access", "error");
                  break;/*
                  router.replace({
                    path: "/login",
                    query: { redirect: router.currentRoute.fullPath }
                  });*/
                   break;
                case 404:
                  Vue.$swal("No Data", "Use another data", "error");
                  break;
                case 422:
                  //var span = document.createElement("span");
                  let msg = '';
                  for(let i=0; i<error.response.data.message.length; i++){
                    msg = msg + error.response.data.message[i];
                    if(i != error.response.data.message.length - 1){
                      msg = msg + '<br>';
                    }
                  }
                  //span.innerHTML=msg;
                  Vue.$swal("Error Validation", msg, "error");
                  break;
                case 500:
                  console.log(error.response.data);
                  Vue.$swal("Server Error", "You can try again later or Call Customer Service", "error");
                  break;
                case 502:/*
                 setTimeout(() => {
                    router.replace({
                      path: "/login",
                      query: {
                        redirect: router.currentRoute.fullPath
                      }
                    });
                  }, 1000);*/
              }
              return Promise.reject(error.response);
            }
          }
        );
}