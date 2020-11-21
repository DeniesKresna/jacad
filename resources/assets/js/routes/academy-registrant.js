import AcademyRegistrantIndex from '../components/pages/academy-registrant/Index.vue';
import AcademyDetail from '../components/pages/academy-registrant/AcademyDetail.vue';
import RegistrantDetail from '../components/pages/academy-registrant/RegistrantDetail.vue';

export const academy_registrant= [
    {
        name: 'AcademyRegistrantIndex',
        path: '/academy-registrant',
        component: AcademyRegistrantIndex
    },
    {
        name: 'AcademyDetail',
        path: '/academy-registrant/academy/:id',
        component: AcademyDetail
    },
    {
        name: 'RegistrantDetail',
        path: '/academy-registrant/registrant/:id',
        component: RegistrantDetail
    },
];