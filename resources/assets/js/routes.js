import Example from './components/ExampleComponent.vue';
import PostIndex from './components/post/Index.vue';
import PostCreate from './components/post/Create.vue';
import CategoryIndex from './components/category/Index.vue';
import CategoryCreate from './components/category/Create.vue';

export const routes = [
    {
        name: 'postIndex',
        path: '/post/',
        component: PostIndex
    },
    {
        name: 'postCreate',
        path: '/post/create',
        component: PostCreate
    },
    {
        name: 'categoryIndex',
        path: '/category/',
        component: CategoryIndex
    },
    {
        name: 'categoryCreate',
        path: '/category/create',
        component: CategoryCreate
    }
/*
    {
        name: 'home',
        path: '/',
        component: AllBooks
    },
    {
        name: 'add',
        path: '/add',
        component: AddBook
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditBook
    }
*/
];