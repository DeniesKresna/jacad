import Vue from 'vue';
import Vuex from 'vuex';
import { state } from './state';
import { actions } from './actions';
import { mutations } from './mutations';
import { getters } from './getters'; 

import blog from './modules/blog';
import tag from './modules/tag';
import job from './modules/_job';
import jsambassador from './modules/jsambassador';

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
    	blog,
        tag,
        job,
        jsambassador
    	/*
        donatur,
        clients,*/
    }
});