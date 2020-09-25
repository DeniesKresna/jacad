import HomeIndex from './components/home/Index.vue';

import BlogIndex from './components/blog/Index.vue';
import BlogCreate from './components/blog/Create.vue';
import BlogEdit from './components/blog/Edit.vue';

import TagIndex from './components/tag/Index.vue';
import TagCreate from './components/tag/Create.vue';

import JobIndex from './components/job/Index.vue';
import JobDetail from './components/job/Detail.vue';

import StudentAmbassadorIndex from './components/studentAmbassador/Index.vue';

export const routes = [
    {
        name: 'homeIndex',
        path: '/',
        component: HomeIndex
    },
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
        name: 'postEdit',
        path: '/blog/:id',
        component: BlogEdit
    },
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
    {
        name: 'jobIndex',
        path: '/job/',
        component: JobIndex
    },
    {
        name: 'jobDetail',
        path: '/job/:id',
        component: JobDetail
    },
    {
        name: 'studentAmbassadorIndex',
        path: '/studentAmbassador',
        component: StudentAmbassadorIndex
    }
/*
    {
        name: 'home',
        path: '/',
        component: AllBooks
    },
    {
        name: 'add',
        path: '/add',
        component: AddBook
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditBook
    }
*/
];