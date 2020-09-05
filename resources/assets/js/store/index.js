import Vue from 'vue';
import Vuex from 'vuex';
import { state } from './state';
import { actions } from './actions';
import { mutations } from './mutations';
import { getters } from './getters'; 

import post from './modules/post';
import category from './modules/category';
import job from './modules/_job';

/*
import donatur from './modules/donatur'
import clients from './modules/clients'*/

Vue.use(Vuex);
export default new Vuex.Store({
  	state,
  	mutations,
  	actions,
  	getters,
    modules: {
    	post,
        category,
        job
    	/*
        donatur,
        clients,*/
    }
});