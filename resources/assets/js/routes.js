import Example from './components/ExampleComponent.vue';
import HomeIndex from './components/home/Index.vue';
import PostIndex from './components/post/Index.vue';
import PostCreate from './components/post/Create.vue';
import PostEdit from './components/post/Edit.vue';
import CategoryIndex from './components/category/Index.vue';
import CategoryCreate from './components/category/Create.vue';

export const routes = [
    {
        name: 'homeIndex',
        path: '/',
        component: HomeIndex
    },
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
        name: 'postEdit',
        path: '/post/:id',
        component: PostEdit
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