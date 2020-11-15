import BlogIndex from '../components/pages/blog/Index.vue';
import BlogCreate from '../components/pages/blog/Create.vue';
import BlogEdit from '../components/pages/blog/Edit.vue';

export const blog= [
    {
        name: 'BlogIndex',
        path: '/blog',
        component: BlogIndex
    },
    {
        name: 'BlogCreate',
        path: '/blog/create',
        component: BlogCreate
    },
    {
        name: 'BlogEdit',
        path: '/blog/:id',
        component: BlogEdit
    }
];