import JobOpening from '../components/pages/job/Opening.vue';
import JobIndex from '../components/pages/job/Index.vue';
import JobEdit from '../components/pages/job/Edit.vue';
import JobDetail from '../components/pages/job/Detail.vue';

export const job= [
    {
        name: 'JobOpening',
        path: '/job/opening',
        component: JobOpening
    },
    {
        name: 'JobIndex',
        path: '/job',
        component: JobIndex
    },
    {
        name: 'JobEdit',
        path: '/job/edit/:id',
        component: JobEdit
    },
    {
        name: 'JobDetail',
        path: '/job/:id',
        component: JobDetail
    }
];