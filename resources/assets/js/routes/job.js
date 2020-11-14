import JobIndex from '../components/pages/job/Index.vue';
import JobDetail from '../components/pages/job/Detail.vue';

export const job= [
    {
        name: 'JobIndex',
        path: '/job',
        component: JobIndex
    },
    {
        name: 'JobDetail',
        path: '/job/:id',
        component: JobDetail
    }
];