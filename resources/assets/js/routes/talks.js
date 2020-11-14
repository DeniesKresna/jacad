import TalksIndex from '../components/pages/talks/Index.vue';
import TalksCreate from '../components/pages/talks/Create.vue';
import TalksEdit from '../components/pages/talks/Edit.vue';

export const talks= [
    {
        name: 'TalksIndex',
        path: '/talks',
        component: TalksIndex
    },
    {
        name: 'TalksCreate',
        path: '/talks/create',
        component: TalksCreate
    },
    {
        name: 'TalksEdit',
        path: '/talks/:id',
        component: TalksEdit
    }
];