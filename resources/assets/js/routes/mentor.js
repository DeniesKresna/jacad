import MentorIndex from '../components/pages/mentor/Index.vue';
import MentorCreate from '../components/pages/mentor/Create.vue';
import MentorEdit from '../components/pages/mentor/Edit.vue';

export const mentor= [
    {
        name: 'MentorIndex',
        path: '/mentor',
        component: MentorIndex
    },
    {
        name: 'MentorCreate',
        path: '/mentor/create',
        component: MentorCreate
    },
    {
        name: 'MentorEdit',
        path: '/mentor/:id',
        component: MentorEdit
    }
];