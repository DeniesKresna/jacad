import AcademyPeriodIndex from '../components/pages/academy-period/Index.vue';
import AcademyPeriodCreate from '../components/pages/academy-period/Create.vue';
import AcademyPeriodCustomer from '../components/pages/academy-period/Customer.vue';
import AcademyPeriodEdit from '../components/pages/academy-period/Edit.vue';

export const academy_period= [
    {
        name: 'AcademyPeriodIndex',
        path: '/academy-period',
        component: AcademyPeriodIndex
    },
    {
        name: 'AcademyPeriodCreate',
        path: '/academy-period/create',
        component: AcademyPeriodCreate
    },
    {
        name: 'AcademyPeriodCustomer',
        path: '/academy-period/customer',
        component: AcademyPeriodCustomer
    },
    {
        name: 'AcademyPeriodEdit',
        path: '/academy-period/:id',
        component: AcademyPeriodEdit
    }
];