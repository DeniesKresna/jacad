import VisitIndex from '../components/pages/visit/Index.vue';
import VisitCreate from '../components/pages/visit/Create.vue';
import VisitEdit from '../components/pages/visit/Edit.vue';

export const visit= [
    {
        name: 'VisitIndex',
        path: '/visit',
        component: VisitIndex
    },
    {
        name: 'VisitCreate',
        path: '/visit/create',
        component: VisitCreate
    },
    {
        name: 'VisitEdit',
        path: '/visit/:id',
        component: VisitEdit
    }
];