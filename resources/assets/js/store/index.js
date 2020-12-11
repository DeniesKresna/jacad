import Vue from 'vue';
import Vuex from 'vuex';

import { state } from './state';
import { actions } from './actions';
import { mutations } from './mutations';
import { getters } from './getters'; 

import user from './modules/user';
import mentor from './modules/mentor';
import opening from './modules/opening';
import tag from './modules/tag';
import category from './modules/category';
import sector from './modules/sector';
import location from './modules/location';
import blog from './modules/blog';
import academy from './modules/academy';
import academy_period from './modules/academy-period';
import ask_career from './modules/ask-career';
import mentoring from './modules/mentoring';
import job from './modules/job';
import job_application from './modules/job-application';
import student_ambassador from './modules/student-ambassador';

Vue.use(Vuex);

export default new Vuex.Store({
  	state,
  	mutations,
  	actions,
  	getters,
    modules: {
        user,
        mentor,
        opening,
        tag,
        category,
        sector,
        location,
        blog,
        academy,
        academy_period,
        ask_career,
        mentoring,
        job,
        job_application,
        student_ambassador
    }
});