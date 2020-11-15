import TagIndex from '../components/pages/tag/Index.vue';
import TagCreate from '../components/pages/tag/Create.vue';

export const tag= [
    {
        name: 'TagIndex',
        path: '/tag',
        component: TagIndex
    },
    {
        name: 'TagCreate',
        path: '/tag/create',
        component: TagCreate
    }
];