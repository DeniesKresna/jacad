import AcademyOpening from '../components/pages/academy/Opening.vue';
import AcademyIndex from '../components/pages/academy/Index.vue';
import AcademyCreate from '../components/pages/academy/Create.vue';
import AcademyEdit from '../components/pages/academy/Edit.vue';

export const academy= [
    {
        name: 'AcademyOpening',
        path: '/academy/opening',
        component: AcademyOpening
    },
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