import Vue from 'vue';
import Vuex from 'vuex';

import { state } from './state';
import { actions } from './actions';
import { mutations } from './mutations';
import { getters } from './getters'; 

import user from './modules/user';
import tag from './modules/tag';
import category from './modules/category';
import blog from './modules/blog';
import job from './modules/job';
import job_application from './modules/job-application';
import academy from './modules/academy';
import academy_registrant from './modules/academy-registrant';
import student_ambassador from './modules/student-ambassador';

Vue.use(Vuex);

export default new Vuex.Store({
  	state,
  	mutations,
  	actions,
  	getters,
    modules: {
        user,
        tag,
        category,
        blog,
        job,
        job_application,
        academy,
        academy_registrant,
        student_ambassador
    }
});