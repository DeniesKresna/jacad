import InternshipIndex from '../components/pages/internship/Index.vue';
import InternshipCreate from '../components/pages/internship/Create.vue';
import InternshipEdit from '../components/pages/internship/Edit.vue';

export const internship= [
    {
        name: 'InternshipIndex',
        path: '/internship',
        component: InternshipIndex
    },
    {
        name: 'InternshipCreate',
        path: '/internship/create',
        component: InternshipCreate
    },
    {
        name: 'InternshipEdit',
        path: '/internship/:id',
        component: InternshipEdit
    }
];