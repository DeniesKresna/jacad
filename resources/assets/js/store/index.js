import Vue from 'vue';
import Vuex from 'vuex';

import { state } from './state';
import { actions } from './actions';
import { mutations } from './mutations';
import { getters } from './getters'; 

import job from './modules/_job';
import blog from './modules/blog';
import studentAmbassador from './modules/studentAmbassador';
import category from './modules/category';
import tag from './modules/tag';

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
        job,
        blog,
        studentAmbassador,
        category,
        tag,
    }
});