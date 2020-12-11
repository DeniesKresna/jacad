import AskCareerOpening from '../components/pages/ask-career/Opening.vue';
import AskCareerIndex from '../components/pages/ask-career/Index.vue';
import AskCareerCreate from '../components/pages/ask-career/Create.vue';
import AskCareerEdit from '../components/pages/ask-career/Edit.vue';

export const ask_career= [
    {
        name: 'AskCareerOpening',
        path: '/ask-career/opening',
        component: AskCareerOpening
    },
    {
        name: 'AskCareerIndex',
        path: '/ask-career',
        component: AskCareerIndex
    },
    {
        name: 'AskCareerCreate',
        path: '/ask-career/create',
        component: AskCareerCreate
    },
    {
        name: 'AskCareerEdit',
        path: '/ask-career/:id',
        component: AskCareerEdit
    }
];