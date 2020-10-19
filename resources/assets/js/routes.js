import HomeIndex from './components/pages/home/Index.vue';

import TagIndex from './components/pages/tag/Index.vue';
import TagCreate from './components/pages/tag/Create.vue';

import BlogIndex from './components/pages/blog/Index.vue';
import BlogCreate from './components/pages/blog/Create.vue';
import BlogEdit from './components/pages/blog/Edit.vue';

import InternshipIndex from './components/pages/internship/Index.vue';
import InternshipCreate from './components/pages/internship/Create.vue';
import InternshipEdit from './components/pages/internship/Edit.vue';

import TalksIndex from './components/pages/talks/Index.vue';
import TalksCreate from './components/pages/talks/Create.vue';
import TalksEdit from './components/pages/talks/Edit.vue';

import VisitIndex from './components/pages/visit/Index.vue';
import VisitCreate from './components/pages/visit/Create.vue';
import VisitEdit from './components/pages/visit/Edit.vue';

import JobIndex from './components/pages/job/Index.vue';
import JobDetail from './components/pages/job/Detail.vue';

import StudentAmbassadorIndex from './components/pages/studentAmbassador/Index.vue';

export const routes = [
    {
        name: 'homeIndex',
        path: '/',
        component: HomeIndex
    },

    //TAG
    {
        name: 'tagIndex',
        path: '/tag/',
        component: TagIndex
    },
    {
        name: 'tagCreate',
        path: '/tag/create',
        component: TagCreate
    },

    //BLOG
    {
        name: 'blogIndex',
        path: '/blog/',
        component: BlogIndex
    },
    {
        name: 'blogCreate',
        path: '/blog/create',
        component: BlogCreate
    },
    {
        name: 'blogEdit',
        path: '/blog/:id',
        component: BlogEdit
    },

    //INTERNSHIP
    {
        name: 'internshipIndex',
        path: '/internship',
        component: InternshipIndex
    },
    {
        name: 'internshipCreate',
        path: '/internship/create',
        component: InternshipCreate
    },
    {
        name: 'internshipEdit',
        path: '/internship/:id',
        component: InternshipEdit
    },

    //TALKS
    {
        name: 'talksIndex',
        path: '/talks',
        component: TalksIndex
    },
    {
        name: 'talksCreate',
        path: '/talks/create',
        component: TalksCreate
    },
    {
        name: 'talksEdit',
        path: '/talks/:id',
        component: TalksEdit
    },

    //VISIT
    {
        name: 'visitIndex',
        path: '/visit',
        component: VisitIndex
    },
    {
        name: 'visitCreate',
        path: '/visit/create',
        component: VisitCreate
    },
    {
        name: 'visitEdit',
        path: '/visit/:id',
        component: VisitEdit
    },

    //JOB
    {
        name: 'jobIndex',
        path: '/job',
        component: JobIndex
    },
    {
        name: 'jobDetail',
        path: '/job/:id',
        component: JobDetail
    },

    //STUDENT AMBASSADOR
    {
        name: 'studentAmbassadorIndex',
        path: '/studentAmbassador',
        component: StudentAmbassadorIndex
    }
];