import AcademyIndex from '../components/pages/academy/Index.vue';
import AcademyCreate from '../components/pages/academy/Create.vue';
import AcademyEdit from '../components/pages/academy/Edit.vue';

export const academy= [
    {
        name: 'AcademyIndex',
        path: '/academy',
        component: AcademyIndex
    },
    {
        name: 'AcademyCreate',
        path: '/academy/create',
        component: AcademyCreate
    },
    {
        name: 'AcademyEdit',
        path: '/academy/:id',
        component: AcademyEdit
    }
];